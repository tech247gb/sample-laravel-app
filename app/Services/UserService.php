<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserService
{
    public function show()
    {
        return User::all();
    }

    public function update(Request $request, $user)
    {
        // dd($request);
        $data = $request->validate([
            'first_name' => 'nullable|min:2|max:255',
            'last_name' => 'nullable|min:2|max:255',
            'password' => ['nullable', Password::min(6)->mixedCase()->numbers()->symbols()->uncompromised()],
            'email' => 'nullable|email',
            'role' => 'nullable',
        ]);
        $user->update($data);
        $user->assignRole($request->input('role'));
        return $user;
    }

    public function destroy($user)
    {
        $user = User::find($user);
        return $user->delete();
    }

    public function logout()
    {
        return Auth::logout();
    }
}
