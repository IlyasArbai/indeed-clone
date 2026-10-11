<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/jobs');
Route::resource('jobs', JobController::class)->only(['index', 'show']);
Route::resource('companies', CompanyController::class)->only(['index', 'show']);

Route::middleware('guest')->group(function () {
    Route::get('/register-type', [AuthController::class, 'registerType']);

    Route::resource('users', UserController::class)->only(['create', 'store']);
    Route::resource('companies', CompanyController::class)->only(['create', 'store']);

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::resource('companies', CompanyController::class)->except(['index', 'show'])->middleware('account.type:company');
    Route::resource('jobs', JobController::class)->except(['index', 'show'])->middleware('account.type:company');

    Route::resource('users', UserController::class)->except(['index', 'create', 'store']);
    Route::resource('applicants', ApplicantController::class);

    Route::resource('dashboard', DashboardController::class)->only(['index', 'edit', 'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
