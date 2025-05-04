<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Redirect;


class UsersController extends Controller
{
    // ユーザー登録フォーム表示
    public function create()
    {
        return view('users.register');
    }

    // ユーザー登録処理
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // ユーザーの作成
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 登録後、ログイン画面へリダイレクト
        return redirect()->route('login')->with('success', 'ユーザー登録が完了しました。ログインしてください。');
    }

}
