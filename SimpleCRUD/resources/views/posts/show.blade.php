@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', '投稿詳細')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')

@endsection

<!-- 本文部分 -->
@section('content')
    <h1>投稿詳細</h1>

    <!-- タイトル -->
    <p><strong>タイトル:</strong> {{ $post->title }}</p>

    <!-- 詳細 -->
    <p><strong>詳細:</strong> {{ $post->detail }}</p>

    <!-- 作成者 -->
    <p><strong>投稿者:</strong> {{ $post->user->name }}</p>

    <!-- 作成日時 -->
    <p><strong>作成日時:</strong> {{ $post->created_at->format('Y-m-d H:i') }}</p>

    <!-- 編集ボタン -->
    <a href="{{ route('posts.edit', $post->id) }}" class="edit-button"
        @if ($post->user_id !== Auth::id()) style="pointer-events: none; color: grey;" tabindex="-1" @endif>
        編集
    </a>

    <!-- 削除ボタン -->
    <form action="{{ route('posts.delete', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button"
            @if ($post->user_id !== Auth::id()) style="pointer-events: none; background-color: grey;" tabindex="-1" @endif>
            削除
        </button>
    </form>

    <br><br>
    <a href="{{ route('posts.index') }}">一覧に戻る</a>
@endsection
