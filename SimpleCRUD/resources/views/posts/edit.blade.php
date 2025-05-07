@extends('partial/common/app')

<!-- 下記にブラウザのタブに表示するタイトルを設定する -->
@section('title', '投稿編集')

<!-- 下記にcssについての内容を記載する -->
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/post_form.css') }}">
@endsection

<!-- 本文部分 -->
@section('content')
    @include('partial.posts.form', [
        'formAction' => route('posts.update', $post->id),
        'isEdit' => true,
        'buttonText' => '更新する',
        'post' => $post,
    ])
@endsection
