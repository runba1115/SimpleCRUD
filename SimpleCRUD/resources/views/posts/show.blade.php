@extends('partial/common/app')

{{-- 下記にブラウザのタブに表示するタイトルを設定する --}}
@section('title', '投稿詳細')

{{-- 下記にcssについての内容を記載する --}}
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/posts_detail_view.css') }}">
@endsection

{{--  本文部分  --}}
@section('content')

    <div class="common_container">
        <!-- メッセージがある場合に表示する -->
        @include("/partial/common/message")

        <div class="posts_detail_view_post">
            {{-- 投稿者とログイン中のユーザーが異なる場合にボタンを無効化するため、クラス名を事前に設定する --}}
            @php
                $editButtonClasses = $post->user_id !== Auth::id() ? 'common_disable_button posts_detail_view_disable_button' : '';
                $deleteButtonClasses = $post->user_id !== Auth::id() ? 'common_disable_button posts_detail_view_disable_button' : '';
            @endphp

            <!-- ユーザー名 -->
            <p class="posts_detail_view_user">ユーザー: {{ $post->user->name }}</p>

            <!-- 作成日時 -->
            <p class="posts_detail_view_created_at">作成日時: {{ $post->created_at->format('Y-m-d H:i') }}</p>

            <!-- タイトル -->
            <p class="posts_detail_view_title">タイトル: {{ $post->title }}</p>

            <!-- 詳細 -->
            <p class="posts_detail_view_detail">詳細: {{ $post->detail }}</p>

            <!-- 編集ボタン -->
            <a href="{{ route('posts.edit', $post->id) }}" class="common_button posts_detail_view_button posts_detail_view_edit_button {{ $editButtonClasses }}">
                編集
            </a>

            <!-- 削除ボタン -->
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="posts_detail_view_delete_form">
                @csrf
                @method('DELETE')
                <input type="submit" class="common_button posts_detail_view_button posts_detail_view_delete_button {{ $deleteButtonClasses }}" value="削除">
            </form>

            <!-- 一覧に戻るボタン -->
            <a href="{{ route('posts.index') }}" class="common_button posts_detail_view_detail_button">
                一覧に戻る
            </a>
        </div>
    </div>
@endsection
