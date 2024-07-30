<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentaIntermediadaController;
use App\Http\Controllers\TecnicoController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\VentaIntermediada;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard-ventasIntermediadas', [DashboardController::class, 'ventasIntermediadas'])->name('ventasIntermediadas');
    Route::get('/dashboard-ventasIntermediadas', [VentaIntermediadaController::class, 'create'])->name('ventasIntermediadas.create');
    Route::post('/dashboard-ventasIntermediadas', [VentaIntermediadaController::class, 'create'])->name('ventasIntermediadas.post');
    Route::get('/dashboard-canjes', [DashboardController::class, 'canjes'])->name('canjes');  
    Route::get('/dashboard-recompensas', [DashboardController::class, 'recompensas'])->name('recompensas');  
    Route::get('/dashboard-tecnicos', [DashboardController::class, 'tecnicos'])->name('tecnicos');  
    Route::get('/dashboard-configuracion', [DashboardController::class, 'configuracion'])->name('configuracion');  
    Route::post('/dashboard-nuevoTecnico', [TecnicoController::class, 'store'])->name('nuevoTecnico.store');  

    Route::get('emailExample', function () {
        Mail::to('garciabetancourtjosue@gmail.com')
            ->send(new ResetPasswordMail);
        return "Mensaje enviado";
    })->name('emailExample');
});

require __DIR__.'/auth.php';
