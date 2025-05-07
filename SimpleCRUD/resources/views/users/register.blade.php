@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', 'ユーザー登録')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/users/user_auth.css') }}">
@endsection

<!-- 本文部分 -->
@section('content')
<div class="user_auth_container">
    <h1 class="user_auth_title">ユーザー登録</h1>

    <!-- エラーメッセージを一括表示 -->
    @if ($errors->any())
        <div class="user_auth_error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="user_auth_form">
        @csrf

        <div class="user_auth_form_group">
            <label for="name" class="user_auth_label">ユーザー名</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="common_input">
        </div>

        <div class="user_auth_form_group">
            <label for="email" class="user_auth_label">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="common_input">
        </div>

        <div class="user_auth_form_group">
            <label for="password" class="user_auth_label">パスワード</label>
            <input type="password" name="password" id="password" required class="common_input">
        </div>

        <div class="user_auth_form_group">
            <label for="password_confirmation" class="user_auth_label">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="common_input">
        </div>

        <div class="user_auth_button_group">
            <button type="submit" class="common_button user_auth_register_button">登録する</button>
        </div>
    </form>
</div>
@endsection
