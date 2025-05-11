@extends('partial/common/app')

@php
    // 定数を使用できるよう、定数の名前空間を使用する旨を記載する
    // ※基底側のファイルに記載しても、派生側のファイルでその名前空間を使用することはできない
    use App\Constants\Constants;
@endphp

{{-- 下記にブラウザのタブに表示するタイトルを設定する --}}
@section('title', 'ユーザー登録')

{{-- 下記にcssについての内容を記載する --}}
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/users/user_auth.css') }}">
@endsection

{{--  本文部分  --}}
@section('content')
    <div class="common_container ">
        <!-- エラーメッセージがあれば表示する -->
        @include('partial/common/message')

        <div class="user_auth_container">
            <h1 class="user_auth_title">ユーザー登録</h1>
        
            <form action="{{ route('users.store') }}" method="POST" class="user_auth_form">
                @csrf
        
                <!-- ユーザー名 -->
                <div class="user_auth_form_group">
                    <label for="{{Constants::USER_COLUMN_NAME}}" class="user_auth_label">ユーザー名</label>
                    <input type="text" name="{{Constants::USER_COLUMN_NAME}}" id="{{Constants::USER_COLUMN_NAME}}" value="{{ old(Constants::USER_COLUMN_NAME) }}" required class="common_input">
                </div>
        
                <!-- メールアドレス -->
                <div class="user_auth_form_group">
                    <label for="{{Constants::USER_COLUMN_EMAIL}}" class="user_auth_label">メールアドレス</label>
                    <input type="email" name="{{Constants::USER_COLUMN_EMAIL}}" id="{{Constants::USER_COLUMN_EMAIL}}" value="{{ old(Constants::USER_COLUMN_EMAIL) }}" required class="common_input">
                </div>
        
                <!-- パスワード -->
                <div class="user_auth_form_group">
                    <label for="{{Constants::USER_COLUMN_PASSWORD}}" class="user_auth_label">パスワード</label>
                    <input type="{{Constants::USER_COLUMN_PASSWORD}}" name="password" id="{{Constants::USER_COLUMN_PASSWORD}}" required class="common_input">
                </div>
        
                <!-- パスワード確認（同じパスワードを再度入力させる） -->
                <div class="user_auth_form_group">
                    <label for="password_confirmation" class="user_auth_label">パスワード確認</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="common_input">
                </div>
        
                <!-- 登録するボタン -->
                <div class="user_auth_button_group">
                    <input type="submit" class="common_button user_auth_register_button" value="登録する">
                </div>
            </form>
        </div>
    </div>
@endsection
