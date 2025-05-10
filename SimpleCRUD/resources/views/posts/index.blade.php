@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', '投稿一覧')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/posts_simple_view.css') }}">
@endsection

<!-- 本文部分 -->
@section('content')

    <div class="common_container">
        <!-- メッセージがある場合に表示 -->
        @if (session('success'))
            <div class="posts_simple_view_alert posts_simple_view_alert_success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="posts_simple_view_alert posts_simple_view_alert_error">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('posts.create') }}" class="common_button posts_simple_view_create_button">新規作成</a>

        @foreach ($posts as $post)
            <div class="posts_simple_view_post">
                <!-- ユーザー名 -->
                <p class="posts_simple_view_user">ユーザー: {{ $post->user->name }}</p>

                <!-- 作成日時 -->
                <p class="posts_simple_view_created_at">作成日時: {{ $post->created_at->format('Y-m-d H:i') }}</p>

                <!-- タイトル -->
                <p class="posts_simple_view_title">タイトル: {{ $post->title }}</p>

                <!-- 詳細 -->
                <p class="posts_simple_view_detail">詳細: {{ $post->detail }}</p>

                <!-- 詳細ボタン -->
                <a href="{{ route('posts.show', $post->id) }}" class="common_button posts_simple_view_button posts_simple_view_detail_button">詳細</a>

                <!-- 編集ボタン -->
                <a href="{{ route('posts.edit', $post->id) }}" class="common_button posts_simple_view_button posts_simple_view_edit_button
                    @if ($post->user_id !== Auth::id()) common_disable_button posts_simple_view_disable_button @endif" >
                    編集
                </a>

                <!-- 削除ボタン -->
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="posts_simple_view_delete_form" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="common_button posts_simple_view_button posts_simple_view_delete_button
                        @if ($post->user_id !== Auth::id()) common_disable_button posts_simple_view_disable_button @endif" >
                        削除
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
