<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KidzavingsController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::get( '/try', [KidzavingsController::class, 'try'])->name('try.index');
Route::get( '/kidzavings', [KidzavingsController::class, 'index'])->name('kidzavings.index');
Route::get( '/scanQr', [KidzavingsController::class, 'scanner'])->name('scanQr.index');
// Route::get( '/account', [KidzavingsController::class, 'account'])->name('account.index');
Route::get('/account/{cardNumber}', [AccountController::class, 'show']);


Route::post('/verify-card', [AccountController::class, 'verify']);

Route::get('/transaction/{cardNumber}', [TransactionController::class, 'index'])->name('transaction.index');
