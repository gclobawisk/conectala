<?php

use App\Http\Controllers\WeatherController;
use App\Http\Middleware\HandleJwtExceptions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;



// Rota pública (sem middleware)
Route::post('login', [AuthController::class, 'login']);

//get só para teste rápido mesmo
Route::get('/weather/{city}', [WeatherController::class, 'show']);

// Rotas protegidas (com middleware)
Route::middleware([HandleJwtExceptions::class])->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
});
