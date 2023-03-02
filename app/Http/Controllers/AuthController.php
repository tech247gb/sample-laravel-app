<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
// dd($user);

        // Perform login or registration logic here
        $this->_registerOrLoginUser($user);
        return redirect('/dashboard');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // Perform login or registration logic here

        return redirect('/dashboard');
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();
        $this->_registerOrLoginUser($user);
        return redirect('/dashboard');
    }

    public function _registerOrLoginUser($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $name = $data->getName();
            $nameParts = explode(' ', $name);
            $first_name = $nameParts[0] ?? '';
            $last_name = $nameParts[1] ?? '';

            $user = new User();
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->email = $data->email;
            $user->provider_id = $data->getId();
            $user->avatar = $data->avatar;
            $user->save();
        }
        Auth::login($user);
    }
}
