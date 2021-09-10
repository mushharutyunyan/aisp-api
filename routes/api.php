<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\TransactionsController;
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


//Route::middleware(['auth:api','scopes:threshold,debit,credit'])->group(function () {
Route::group(['prefix' => 'v1','middleware' => 'auth:api'],function () {
    Route::group(['prefix' => 'transactions'],function () {
        Route::post('threshold', [TransactionsController::class, 'threshold']);
        Route::post('{type}', [TransactionsController::class, 'creditDebit']);
    });
});
