<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function authenticate(LoginRequest $request, $deviceName = 'default')
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken($deviceName);
            return $token;
        } else {
            abort(Response::HTTP_UNAUTHORIZED, 'Email/Password combination is incorrect');
        }
    }
}
