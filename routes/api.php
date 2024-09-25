<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login_tecnicoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

    //RUTAS API
    Route::post('/loginmovil/login-tecnico', [Login_tecnicoController::class, 'login']);
    Route::get('/loginmovil/login-DataTecnico', [Login_tecnicoController::class, 'getAllTecnicos']);
    Route::get('/csrf-token', [Login_tecnicoController::class, 'getCsrfToken']);