<?php

namespace App\Actions;

use App\Models\Domain;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
/*use App\Events\Domain\DomainCreated;*/

/**
 * Create a tenant with the necessary information for the application.
 *
 * We don't use a listener here, because we want to be able to create "simplified" tenants in tests.
 * This action is only used when we need to create the tenant properly (with billing logic etc).
 */
class CreateTenantAction
{
    public function __invoke(array $data, bool $createStripeCustomer = true): Tenant  //string $domain
    {
        $tenant = $this->createTenant($data);
        // $this->createDomain($tenant, $domain);
        $user = $this->createUser($tenant);
        $team = $this->createAdminTeam($tenant);
        $team->users()->attach($user);

        return $tenant;
    }

    protected function createTenant(array $data): Tenant
    {
        return Tenant::create($data + [
            'ready' => true,
            'trial_ends_at' => now()->addDays(config('saas.trial_days')),
        ]);
    }

    // protected function createDomain(Tenant $tenant, string $domain): Domain
    // {
    //     $domainModel = $tenant->createDomain([
    //         'domain' => $domain,
    //         'location_name' => $tenant->company . ' (Main Location)',
    //     ])->makePrimary()->makeFallback();
    //     //DomainCreated::dispatch($domainModel->fresh());
    //     return $domainModel;
    // }

    protected function createUser(Tenant $tenant): User
    {
         return User::create(
             $tenant->only(['first_name', 'last_name', 'email', 'password'])
         );
    }

    protected function createAdminTeam(Tenant $tenant): Team
    {
        return $tenant->teams()->create([
            'name' => 'Admins',
            'is_primary' => true,
        ]);
    }
}
