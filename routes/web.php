<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class)
->only(['create','store','edit','update','destroy'])->middleware('auth');

Route::resource('articles', ArticleController::class)
->except(['create','store','edit','update','destroy']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');
Route::get('registration', [UserController::class, 'create'])->name('registration');
Route::post('registration', [UserController::class, 'store'])->name('registration.store');

Route::get('/user/articles', [ArticleController::class, 'myArticles'])->name('articles.user')->middleware('auth');

Route::resource('comments', CommentController::class)
->only(['store','update','destroy'])->middleware('auth');