<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

// ユーザー登録
Route::get('/register', [UsersController::class, 'create'])->name('users.create'); // ユーザー登録フォーム表示
Route::post('/register', [UsersController::class, 'store'])->name('users.store'); // ユーザー登録処理

// ログイン
Route::get('/login', [UsersController::class, 'showLoginForm'])->name('users.login');
Route::post('/login', [UsersController::class, 'login'])->name('users.login.attempt');

// ログアウト
Route::get('/logout', [UsersController::class, 'logout'])->name('users.logout');