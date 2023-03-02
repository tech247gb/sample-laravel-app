<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('loginForm');

Route::controller(RegisterController::class)->group(function () {
    Route::get('/registeration', 'registerForm')->name('registeration');
    Route::post('/register', 'register')->name('register');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/edit/{user}', [UserController::class, 'editUser'])->name('editUser');//editUser
    Route::delete('/delete/{user}', [UserController::class, 'deleteUser'])->name('deleteUser');//editUser
    Route::put('/update/{user}', [UserController::class, 'updateUser'])->name('updateUser');//editUser

    Route::get('/registeration2', [RegisterController::class, 'registerForm'])->name('registeration2');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('admin');
// });

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::controller(AuthController::class)->group(function () {

    Route::get('/auth/google', 'redirectToGoogle')->name('google.login');  //Google
    Route::get('/auth/google/callback', 'handleGoogleCallback');

    Route::get('/auth/facebook', 'redirectToFacebook')->name('facebook.login'); //Facebook
    Route::get('/auth/facebook/callback', 'handleFacebookCallback');

    Route::get('/auth/github', 'redirectToGithub')->name('github.login');  //Github
    Route::get('/auth/github/callback', 'handleGithubCallback');
});
