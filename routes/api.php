<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController; 
use App\Http\Controllers\GenreController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Definir las rutas de la API
Route::apiResource('games', GameController::class);
Route::apiResource('genres', GenreController::class);