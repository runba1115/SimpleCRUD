<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Redirect;
use App\Constants\Constants;

class UsersController extends Controller
{
    /**
     * ユーザー登録フォームを表示する。
     * 
     * @return \Illuminate\View\View ユーザ登録フォームのビュー
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * ユーザー登録処理
     * 
     * バリデーションにてユーザ名などが登録可能である条件を確認した後、ユーザー登録を行う。
     * 登録不可の場合、自動的に元のページに戻る。
     * （その時、自動的に入力した値の復元、エラーメッセージの設定などが行われる。）
     * 登録成功後はログインページにリダイレクトする。
     *
     * @param  \Illuminate\Http\Request  $request フォームにて入力された値
     * @return \Illuminate\Http\RedirectResponse リダイレクト先
     */
    public function store(Request $request)
    {
        // ユーザー名、メール、パスワードの確認を行う
        // ※登録可能である条件を満たしていない場合、自動的に元のページに戻る。
        // （その時、自動的に入力した値の復元、エラーメッセージの設定などが行われる。）
        $validated = $request->validate([
            Constants::USER_COLUMN_NAME => Constants::USERS_NAME_VALIDATE,
            Constants::USER_COLUMN_EMAIL => Constants::USERS_EMAIL_VALIDATE,
            Constants::USER_COLUMN_PASSWORD => Constants::USERS_PASSWORD_VALIDATE,
        ]);

        // ユーザーの作成を行う
        // バリデーションでユーザーの入力した値の確認は行っているが、
        // DBに接続できないなどの理由で例外が発生する可能性がある。念のため、try-catchを仕込んでいる。
        try
        {
            $user = User::create([
                Constants::USER_COLUMN_NAME => $validated[Constants::USER_COLUMN_NAME],
                Constants::USER_COLUMN_EMAIL => $validated[Constants::USER_COLUMN_EMAIL],
                Constants::USER_COLUMN_PASSWORD => Hash::make($validated[Constants::USER_COLUMN_PASSWORD]),
            ]);
    
            // 登録後、ログイン画面へリダイレクトする
            return redirect()->route('users.login')->with('success', Constants::USERS_REGISTER_SUCCESS);
        }
        catch(\Exception $e) 
        {
            // ユーザーに、ユーザーが入力した値以外によるエラーメッセージを表示するのは望ましくない。
            // エラーの内容をログファイルに出力する。
            \Log::error("ユーザー登録エラー: " . $e->getMessage());

            // ユーザーには一般的なエラーメッセージを表示して元のフォームに戻す
            return back()->withErrors(['error' => Constants::USERS_REGISTER_ERROR])->withInput();
        }
    }
    
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('users.login');
    }

    /**
     * ログイン処理を行う
     * 認証に失敗した場合、エラーメッセージを表示し、再度ログインフォームに戻る。
     * ※メールアドレスまたはパスワードが間違っている場合に認証に失敗する。
     *
     * @param  \Illuminate\Http\Request  $request フォームに入力された値
     * @return \Illuminate\Http\RedirectResponse リダイレクト先
     */
    public function login(Request $request)
    {
        // ユーザーが入力したメールアドレスとパスワードを取得する
        // ユーザーからこれら以外の値が送信された場合に不要なデータにより想定しない動作が起こるのを防ぐため
        $credentials = $request->only(Constants::USER_COLUMN_EMAIL, Constants::USER_COLUMN_PASSWORD);

        // 認証を行う。
        // ログイン状態を保持するよう入力されている場合、認証を行う関数の第2引数にtrueを渡し、ログイン状態を保持する
        if (Auth::attempt($credentials, $request->filled('remember'))) 
        {
            // 認証に成功した（メールアドレス、パスワードがデータベースに保存されているものとあっている）

            // 新たにセッションIDを作成し、それをDB側、ユーザー側の両方に保存する。
            // ※ユーザ側に、DB側に保存されているセッションIDと同じものがある場合、ログインしていると認識される。
            // ※新たに作成するのは、以前のIDを用いて不正な動作が行われることを防ぐため。
            $request->session()->regenerate();

            // ログイン成功時専用の画面は作成していない。
            // ログイン成功メッセージとともに投稿一覧画面にリダイレクトする
            return redirect()->route('posts.index')->with('success', Constants::USERS_LOGIN_SUCCESS);
        }

        // 認証に失敗した（メールアドレス、パスワードがデータベースに保存されているものとあっていない）
        // ログイン画面にリダイレクトする。
        // メッセージは、認証に失敗した旨のみとする。（どちらが間違っているか表示すると悪用される可能性があるため。）
        return back()->withErrors([Constants::USERS_LOGIN_FAILED])->withInput($request->only(Constants::USER_COLUMN_EMAIL, 'remember'));
    }

    /**
     * ユーザーログアウト処理を行う
     * 
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // 現在のユーザーをログアウトさせる。
        Auth::logout();

        // DB側でセッションIDを作成しなおす。（これにより、ユーザー側に保存されているセッションIDが無効になる。）
        $request->session()->invalidate();

        // CSRFトークンを再生成し、過去のトークンを無効にすることで、不正な操作を防ぐ。
        $request->session()->regenerateToken();

        return redirect()->route('users.login')->with('success', Constants::USERS_LOGOUT_SUCCESS);
    }

}
