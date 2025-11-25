<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('clients', ClientController::class);
    Route::post('clients/{id}/restore', [ClientController::class,'restore'])->name('clients.restore');
    Route::post('/clients/import', [ClientController::class, 'import'])->name('clients.import');
    Route::get('/clients/export', [ClientController::class, 'export'])->name('clients.export');

});
