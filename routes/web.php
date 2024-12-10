<?php

use App\Http\Controllers\HseChecklistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Di LoginController

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Resource route untuk HSE Report
    Route::resource('hse_report', HseChecklistController::class);

    // Custom routes untuk approve dan reject
    Route::post('hse_report/{id}/approve', [HseChecklistController::class, 'approve'])->name('hse_report.approve');

    Route::post('hse_report/{id}/reject', [HseChecklistController::class, 'reject'])->name('hse_report.reject');

    // Route::get('hse_report/export', [HseChecklistController::class, 'exportToPDF'])->name('hse_report.export');
    // Route::get('/hse_report/{id}', [HseChecklistController::class, 'show'])->name('hse_report.show');
    // Route::post('hse_report/{id}/{action}', [HseChecklistController::class, 'update'])->name('hse_report.update');
});
