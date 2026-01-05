<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\LeadController;
use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Web\FollowUpController;
use App\Http\Controllers\Web\DashboardController;




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
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::patch('leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');


    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');


    Route::resource('clients', ClientController::class);
    Route::post('/clients/import', [ClientController::class, 'import'])->name('clients.import');

    Route::resource('leads', LeadController::class);
   Route::post('/leads/{lead}/follow-up', [FollowUpController::class, 'store']);
   Route::patch('/follow-up/{followUp}/done', [FollowUpController::class, 'markDone']);

 


   //    Route::get('/test-email', function () {
   //  \Mail::raw('LeadBridge Test Email', function ($m) {
   //      $m->to('test@lead.com')   // apni ya test email
   //        ->subject('Follow-up Reminder Test');
   //  });
   //  return 'Test email sent! Check Mailtrap Inbox.';
   // });

   // Route::get('/test-email-template', function () {
   //  $lead = Lead::first();
   //  $user = User::first();

   //  return view('emails.leads.new-lead', compact('lead', 'user'));
   //  });

    Route::post('/followups', [FollowUpController::class, 'store'])->name('followups.store');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });





