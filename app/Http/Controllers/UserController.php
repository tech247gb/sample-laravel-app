<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = $this->userService->show();
        return view('dashboard', compact('user'));
    }

    public function editUser($user)
    {
        $roles = Role::pluck('name')->all();
        $user=User::find($user);
        return view('editUser', compact('roles', 'user'));
    }

    public function updateUser(Request $request ,User $user)
    {

        $this->userService->update($request , $user);
        return redirect()->route('dashboard')->with('success', 'User Has Been updated successfully');

        // dd($user);
    }

    public function deleteUser($user)
    {
        $this->userService->destroy($user);
        return back();
    }
}
