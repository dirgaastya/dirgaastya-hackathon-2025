<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TransactionController;
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

Route::prefix('category')->group(function () {
    Route::get('get-all-categories', [CategoriesController::class, 'getAllCategories']);
});
Route::prefix('transaction')->group(function () {
    Route::post('get-transactions', [TransactionController::class, 'getTransactions']);
    Route::post('get-summary-category', [TransactionController::class, 'getSummaryCategory']);
});
