<?php

use App\Http\Controllers\Nyt\BestSellersController;
use Illuminate\Http\Request;
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

Route::prefix('v1')->group(function () {
    Route::prefix('nyt')->group(function () {
        Route::get('best-sellers', [BestSellersController::class, 'index'])->name('nyt.best-sellers');
    });
});
