<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\UsuarioController;
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
        Route::get('/', [UsuarioController::class, 'index']);
        Route::put('/', [UsuarioController::class, 'update']);
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
});
