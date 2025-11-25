<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('clients', ClientController::class);


    // Route::post('/clients', [ClientController::class, 'store']);
    // Route::get('/clients', [ClientController::class, 'index']);
    // Route::get('clients/{client}', [ClientController::class, 'show']);
    // Route::patch('/clients/{id}', [ClientController::class, 'update']);
    // Route::patch('clients/{client}', [ClientController::class, 'update']);
    // Route::delete('clients/{client}', [ClientController::class, 'destroy']);
});

