<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Soporte\SoporteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rutas protegidas por middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    
    // Verificación de email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');


    /**---------------------- RUTAS ADMINISTRADOR ------------------------ */
    Route::prefix('colaborador')->group(function () {

        //RUTA PARA OBTENER LAS ESPECIES (ANIMALES)
        Route::get('/getEspecies', [SoporteController::class, 'getEspecies']);
        //RUTA PARA GUARDAR REGISTROS DE ESPECIES
        Route::post('/guardarEspecie', [SoporteController::class, 'guardarEspecie']);
        //RUTA PARA MODIFICAR REGISTROS DE ESPECIES
        Route::post('/editarEspecie', [SoporteController::class, 'editarEspecie']);
        //RUTA PARA ELIMINAR REGISTROS DE ESPECIES
        Route::post('/eliminarEspecie', [SoporteController::class, 'eliminarEspecie']);
    });
});
