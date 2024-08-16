<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;


Route::post('/login', [LoginController::class, 'login']);
Route::post('/search-cep', [RegisterController::class, 'getViaCep'])->name('search.cep');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/list-users', [HomeController::class, 'listUsers'])->name('users');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
