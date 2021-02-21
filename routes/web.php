<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RenderImageController;
use App\Http\Middleware\SiteAdmin;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('i/{image}/{type?}', RenderImageController::class)->name('view-image');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/images', ImageController::class)->name('images');

    Route::middleware(SiteAdmin::class)
        ->get('/control-panel', function () {
            return view('control-panel.index');
        })
        ->name('control-panel');
});
