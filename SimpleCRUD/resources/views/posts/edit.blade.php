@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', 'ユーザー登録')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')

@endsection

<!-- 本文部分 -->
@section('content')
<h1>投稿編集</h1>

<!-- バリデーションエラー表示 -->
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- 編集フォーム -->
<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- タイトル -->
    <div>
        <label for="title">タイトル:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
    </div>

    <!-- 詳細 -->
    <div>
        <label for="detail">詳細:</label>
        <textarea id="detail" name="detail" rows="4" required>{{ old('detail', $post->detail) }}</textarea>
    </div>

    <button type="submit">更新する</button>
</form>
<a href="{{ route('posts.show', $post->id) }}">詳細へ戻る</a>
@endsection
