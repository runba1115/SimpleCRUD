<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        return redirect()->route('users.login')->with('success', 'ユーザー登録が完了しました。ログインしてください。');
    }
    
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('users.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('posts.index');
        }

        return back()->withErrors([
            'email' => '認証に失敗しました。',
        ])->withInput($request->only('email', 'remember'));
    }

    // ログアウト
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.login');
    }

}
