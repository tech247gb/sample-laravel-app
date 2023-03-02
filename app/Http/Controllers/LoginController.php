<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        $token = $this->loginService->authenticate($request, $request->device_name ?? 'default');
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        // dd()
        $user= Auth::logout();
        return redirect('login');
    }
}
