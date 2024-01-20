<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Resources\UsuarioResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'usuarios'], function() {
        Route::delete('/logout', [AuthController::class, 'logout']);
        // Route::get('/', [UsuarioController::class, 'index']);
        // Route::patch('/', [UsuarioController::class, 'update']);
    });

    Route::group(['prefix' => 'despesas'], function() {
        Route::post('/', [DespesaController::class, 'store']);
        Route::delete('/{id}', [DespesaController::class, 'delete']);
        Route::get('/', [DespesaController::class, 'index']);
        Route::get('/{id}', [DespesaController::class, 'show']);
        Route::patch('/', [DespesaController::class, 'update']);
    });
});

Route::group(['prefix' => 'usuarios'], function() {
    Route::post('/', [UsuarioController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/', [UsuarioController::class, 'index']);
    Route::get('/{id}', [UsuarioController::class, 'show']);
    Route::patch('/{id}', [UsuarioController::class, 'update']);
    Route::delete('/{id}', [UsuarioController::class, 'destroy']);
});
