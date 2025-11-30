<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;

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


// 👇 Guest Routes (Without Login Allowed)
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// 👇 Authenticated Routes (Login Required)
Route::middleware(['auth'])->group(function () {
        Route::get('/clients/export', [ClientController::class, 'export'])->name('clients.export');

    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');


    Route::resource('clients', ClientController::class);
    Route::post('/clients/import', [ClientController::class, 'import'])->name('clients.import');

    Route::resource('leads', LeadController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
