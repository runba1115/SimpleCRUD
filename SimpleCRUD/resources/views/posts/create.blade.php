@extends('partial/common/app')

{{-- 下記にブラウザのタブに表示するタイトルを設定する --}}
@section('title', '投稿作成')

{{-- 下記にcssについての内容を記載する --}}
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/posts/post_form.css') }}">
@endsection

{{--  本文部分  --}}
@section('content')
    {{-- 投稿作成画面用の引数でフォームを表示する --}}
    @include('partial.posts.form', [
        'formAction' => route('posts.store'),
        'isEdit' => false,
        'buttonText' => '投稿する',
    ])
@endsection
