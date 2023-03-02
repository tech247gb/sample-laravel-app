<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('settings');
        }
    }

    public function index()
    {
        // dd(auth()->user()->hasRole('admin'));
        if (auth()->user()->hasRole('admin')) {
            $user = User::all();
            return view('settings', compact('user'));
        }
    }
}
