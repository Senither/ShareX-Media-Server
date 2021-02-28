<?php

use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImposterController;
use App\Http\Controllers\RenderImageController;
use App\Http\Controllers\RenderTextController;
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

Route::redirect('/', '/login');

Route::get('i/{image}/{type?}', RenderImageController::class)->name('view-image');
Route::get('t/{text}/{raw?}', RenderTextController::class)->name('view-text');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard.index')->name('dashboard');
    Route::view('/images', 'images.index')->name('images');

    Route::get('/imposter/leave', [ImposterController::class, 'leave'])->name('imposter.leave');
    Route::get('/imposter/{user}', [ImposterController::class, 'join'])
        ->middleware(SiteAdmin::class)
        ->name('imposter.join');

    Route::view('/control-panel', 'control-panel.index')
        ->middleware(SiteAdmin::class)
        ->name('control-panel');
});
