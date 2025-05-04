@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', '投稿一覧')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')

@endsection

<!-- 本文部分 -->
@section('content')
    @foreach ($posts as $post)
        <div>
            <!-- ユーザー名 -->
            <p>ユーザー: {{ $post->user->name }}</p>

            <!-- 作成日時 -->
            <p>作成日時: {{ $post->created_at->format('Y-m-d H:i') }}</p>

            <!-- タイトル -->
            <p>タイトル: {{ $post->title }}</p>

            <!-- 詳細 -->
            <p>詳細: {{ $post->detail }}</p>

            <!-- 詳細ボタン -->
            <a href="{{ route('posts.show', $post->id) }}">詳細</a>

            <!-- 編集ボタン -->
            <a href="{{ route('posts.edit', $post->id) }}" class="edit-button"
                @if ($post->user_id !== Auth::id()) style="pointer-events: none; color: grey;" @endif>編集</a>

            <!-- 削除ボタン -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button"
                    @if ($post->user_id !== Auth::id()) style="pointer-events: none; background-color: grey;" @endif>
                    削除
                </button>
            </form>
        </div>
        <hr>
    @endforeach
@endsection
