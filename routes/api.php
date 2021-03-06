<?php

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\TextController;
use App\Http\Controllers\Api\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::resource('/images', ImageController::class)
         ->only(['index', 'show', 'store', 'destroy']);

    Route::resource('/texts', TextController::class)
         ->only(['index', 'show', 'store', 'destroy']);

    Route::resource('/urls', UrlController::class)
         ->only(['index', 'show', 'store', 'destroy']);
});
