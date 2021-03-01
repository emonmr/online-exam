<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'exam'], function () {
    Route::get('', [\App\Http\Controllers\ExamController::class, 'index']);
    Route::get('result/{examId}/{userId}', [\App\Http\Controllers\ExamController::class, 'result']);
    Route::post('store/{id}', [\App\Http\Controllers\ExamController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\ExamController::class, 'detail']);

});

