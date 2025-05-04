@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', '投稿作成')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')

@endsection

<!-- 本文部分 -->
@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <label for="title">タイトル</label><br>
    <input type="text" name="title" id="title" required value="{{ old('title') }}"><br><br>
    <!-- タイトルのエラーメッセージを表示 -->
    @error('title')
        <div>{{ $message }}</div>
    @enderror

    <label for="detail">詳細</label><br>
    <textarea name="detail" id="detail" rows="5" required>{{ old('detail') }}</textarea><br><br>
    <!-- 詳細のエラーメッセージを表示 -->
    @error('detail')
        <div style="color: red;">{{ $message }}</div>
    @enderror

    <button type="submit">投稿する</button>
</form>
@endsection
