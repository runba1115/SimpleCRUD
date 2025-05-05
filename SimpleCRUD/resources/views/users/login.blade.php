@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', 'ログイン')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')

@endsection

<!-- 本文部分 -->
@section('content')
<h1>ログイン</h1>

<!-- エラーメッセージ表示 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('users.login.attempt') }}">
    @csrf

    <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label>
            <input type="checkbox" name="remember"> ログイン状態を保持する
        </label>
    </div>

    <div>
        <button type="submit">ログイン</button>
    </div>

    <div>
        <a href="#">パスワードをお忘れですか？</a>
    </div>
</form>
@endsection
