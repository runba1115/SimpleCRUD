<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;

// ユーザー関係
// ユーザー登録
Route::get('/register', [UsersController::class, 'create'])->name('users.create'); // ユーザー登録フォーム表示
Route::post('/register', [UsersController::class, 'store'])->name('users.store'); // ユーザー登録処理

// ログイン
Route::get('/login', [UsersController::class, 'showLoginForm'])->name('users.login');
Route::post('/login', [UsersController::class, 'login'])->name('users.login.attempt');

// ログアウト
Route::get('/logout', [UsersController::class, 'logout'])->name('users.logout');

// 投稿関係
Route::get('posts/create', [PostsController::class, 'create'])->name('posts.create'); // 投稿作成ページ
Route::post('posts/store', [PostsController::class, 'store'])->name('posts.store'); // 投稿保存
Route::get('posts/index', [PostsController::class, 'index'])->name('posts.index'); // 投稿一覧ページ
Route::get('posts/show/{id}', [PostsController::class, 'show'])->name('posts.show'); // 投稿詳細
Route::get('posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit'); // 投稿編集
Route::put('posts/update/{id}', [PostsController::class, 'update'])->name('posts.update'); // 投稿更新
Route::delete('posts/destroy/{id}', [PostsController::class, 'destroy'])->name('posts.destroy'); // 投稿削除






