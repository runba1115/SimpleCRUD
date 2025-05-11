@extends('partial/common/app')

{{-- 下記にブラウザのタブに表示するタイトルを設定する --}}
@section('title', 'ログイン')

{{-- 下記にcssについての内容を記載する --}}
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/users/user_auth.css') }}">
@endsection

{{--  本文部分  --}}
@section('content')
    <div class="common_container">
        <!-- エラーメッセージがあれば表示する -->
        @include('partial/common/message')

        <div class="user_auth_container">
            <h1 class="user_auth_title">ログイン</h1>

            <form method="POST" action="{{ route('users.login.attempt') }}" class="user_auth_form">
                @csrf

                <!-- メールアドレス -->
                <div class="user_auth_form_group">
                    <label for="email" class="user_auth_label">メールアドレス</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="user_auth_input">
                </div>

                <!-- パスワード -->
                <div class="user_auth_form_group">
                    <label for="password" class="user_auth_label">パスワード</label>
                    <input id="password" type="password" name="password" required class="user_auth_input">
                </div>

                <!-- ログイン状態を保持する チェックボックス -->
                <div class="user_auth_checkbox">
                    <label>
                        <input type="checkbox" name="remember"> ログイン状態を保持する
                    </label>
                </div>

                <!-- ログインボタン -->
                <div class="user_auth_button_group">
                    <input type="submit" class="common_button user_auth_login_button" value="ログイン">
                </div>

                <!-- パスワードを忘れた場合に使用するリンク※現状動作しない -->
                <div class="user_auth_link">
                    <a href="#">パスワードをお忘れですか？</a>
                </div>
            </form>
        </div>
    </div>
@endsection
