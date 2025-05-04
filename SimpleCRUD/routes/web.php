<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/register', [UsersController::class, 'create'])->name('users.create'); // ユーザー登録フォーム表示
Route::post('/register', [UsersController::class, 'store'])->name('users.store'); // ユーザー登録処理
