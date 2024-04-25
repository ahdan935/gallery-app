<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes([
    'email' => false,
    'request' => false,
    'reset' => false,
    'update' => false
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('albums', App\Http\Controllers\AlbumController::class)->except(['show'])->middleware('auth');
Route::get('albums/{album}', [\App\Http\Controllers\AlbumController::class, 'show'])->name('albums.show');

Route::resource('albums.photos', App\Http\Controllers\PhotoController::class)->except(['index', 'show'])->middleware('auth');
Route::get('photos/{photo}', [\App\Http\Controllers\PhotoController::class, 'show'])->name('photos.show');

Route::resource('likes', App\Http\Controllers\LikeController::class)->except(['create', 'show', 'edit', 'update'])->middleware('auth');

Route::resource('comments', App\Http\Controllers\CommentController::class)->except(['create', 'show', 'edit', 'update'])->middleware('auth');
