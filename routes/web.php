<?php

use App\Http\Controllers\ImposterController;
use App\Http\Controllers\RenderFileController;
use App\Http\Controllers\RenderImageController;
use App\Http\Controllers\RenderTextController;
use App\Http\Controllers\RenderUrlController;
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
Route::fallback(fn () => redirect('/'));

Route::get('i/{image}/{type?}', RenderImageController::class)
     ->name('view-image');
Route::get('t/{text}/{raw?}', RenderTextController::class)
     ->where(['raw' => 'raw'])
     ->name('view-text');
Route::get('u/{url}/{preview?}', RenderUrlController::class)
     ->where(['preview' => 'preview'])
     ->name('view-url');
Route::get('f/{file}/{type?}', RenderFileController::class)
     ->where(['type' => 'raw|preview'])
     ->name('view-file');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard.index')->name('dashboard');
    Route::view('images', 'images.index')->name('images');
    Route::view('texts', 'text.index')->name('texts');
    Route::view('urls', 'url.index')->name('urls');
    Route::view('files', 'files.index')->name('files');

    Route::get('imposter/leave', [ImposterController::class, 'leave'])
          ->name('imposter.leave');
    Route::get('imposter/{user}', [ImposterController::class, 'join'])
          ->middleware(SiteAdmin::class)
          ->name('imposter.join');

    Route::view('control-panel', 'control-panel.index')
          ->middleware(SiteAdmin::class)
          ->name('control-panel');
});
