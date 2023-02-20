<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Actions\CreateTenantAction;
use Illuminate\Http\Response;
use App\Http\Resources\TenantResource;
use App\Http\Resources\TokenResource;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $tenant = (new CreateTenantAction())($request->validated(), $request->get('domain'));

        $user = $tenant->teams->first()->users->first();

        return response()->json([
            'message' => 'Tenant created successfully',
            'tenant' => TenantResource::make($tenant),
            'token' => new TokenResource($user->createToken('default')),
        ], Response::HTTP_CREATED);
    }
}
