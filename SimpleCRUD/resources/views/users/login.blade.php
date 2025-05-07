@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', 'ログイン')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/users/user_auth.css') }}">
@endsection

<!-- 本文部分 -->
@section('content')
    <div class="user_auth_container">
        <h1 class="user_auth_title">ログイン</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.login.attempt') }}" class="user_auth_form">
            @csrf

            <div class="user_auth_form_group">
                <label for="email" class="user_auth_label">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="user_auth_input">
            </div>

            <div class="user_auth_form_group">
                <label for="password" class="user_auth_label">パスワード</label>
                <input id="password" type="password" name="password" required class="user_auth_input">
            </div>

            <div class="user_auth_checkbox">
                <label>
                    <input type="checkbox" name="remember"> ログイン状態を保持する
                </label>
            </div>

            <div class="user_auth_button_group">
                <button type="submit" class="common_button user_auth_login_button">ログイン</button>
            </div>

            <div class="user_auth_link">
                <a href="#">パスワードをお忘れですか？</a>
            </div>
        </form>
    </div>
@endsection
