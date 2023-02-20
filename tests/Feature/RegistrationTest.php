<?php

namespace Tests\Feature\API\V1;

use App\Actions\CreateTenantAction;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_tenant_registration()
    {
        $request = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'domain' => uniqid('domain-', true),
            'password' => 'passwoAS@123',
            'email' => $this->faker->email
        ];

        $response = $this->postJson('/api/register', $request);
        $response->assertStatus(201);

        $this->assertDatabaseHas('tenants', [
            'email' => $request['email'],
        ]);

        $tenant = Tenant::where('email', $request['email'])->first();

        $this->assertDatabaseHas('users', [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
        ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Admins',
            'tenant_id' => $tenant->getKey()
        ]);

        $team = $tenant->teams()->first();

        $this->assertDatabaseHas('team_user', [
            'team_id' => $team->getKey(),
            'user_id' => User::where('email', $request['email'])->first()->getKey()
        ]);
    }

    /**
     * @dataProvider getTenantRegistrationData
     */
    public function test_tenant_registration_errors(array $data, int $statusCode, array $errorFields)
    {
        $this->expectException(ValidationException::class);
        $response = $this->post('/api/register', $data);
        $response->assertStatus($statusCode);
        $response->assertJsonValidationErrors($errorFields);
    }

    public function getTenantRegistrationData()
    {
        return [
            [
                [
                    'last_name' => 'Smith',
                    'domain' => uniqid('domain-', true),
                    'password' => 'password',
                    'email' => 'john@doe.com'
                ],
                302,
                [
                    'first_name'
                ]
            ],
            [
                [
                    'first_name' => 'John',
                    'domain' => uniqid('domain-', true),
                    'password' => 'password',
                    'email' => 'john@doe.com'
                ],
                302,
                [
                    'last_name'
                ]
            ],
            [
                [
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'password' => 'password',
                    'email' => 'john@doe.com'
                ],
                302,
                [
                    'domain'
                ]
            ],
            [
                [
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'domain' => uniqid('domain-', true),
                    'email' => 'john@doe.com'
                ],
                302,
                [
                    'password'
                ]
            ],
        ];
    }
}
