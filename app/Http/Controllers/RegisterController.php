<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Actions\CreateTenantAction;
use Illuminate\Http\Response;
use App\Http\Resources\TenantResource;
use App\Http\Resources\TokenResource;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function registerForm()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('register', compact('roles'));
    }

    public function register(RegisterRequest $request)
    {
        $tenant = (new CreateTenantAction())($request->validated());
        $user = $tenant->teams->first()->users->first();

        TenantResource::make($tenant);
        new TokenResource($user->createToken('default'));

        if ($request->input('role')) {
            $user->assignRole($request->input('role'));
            return redirect()->route('dashboard');
        }
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('dashboard');
    }
}
