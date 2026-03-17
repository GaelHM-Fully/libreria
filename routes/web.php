<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PastelController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLICO
|--------------------------------------------------------------------------
*/

// Catálogo público
Route::get('/', [PastelController::class, 'index'])->name('pasteles.index');

// Login / Logout
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROTEGIDO (requiere sesión)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.session'])->group(function () {

    // Dashboard (aquí vive la interfaz)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Catálogo para logueados también
    Route::get('/pasteles', [PastelController::class, 'index'])->name('pasteles.list');

    // SOLO ADMIN: CRUD usuarios
    Route::middleware(['admin.only'])->group(function () {
        Route::resource('usuarios', UsuarioController::class);
    });
});