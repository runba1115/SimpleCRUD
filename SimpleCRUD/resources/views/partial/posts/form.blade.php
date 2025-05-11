@php
    // 定数を使用できるよう、定数の名前空間を使用する旨を記載する
    // ※基底側のファイルに記載しても、派生側のファイルでその名前空間を使用することはできない
    use App\Constants\Constants;
@endphp

<div class="common_container">
    @include("partial/common/message")
</div>

<!-- 投稿フォーム -->
<form action="{{ $formAction }}" method="POST" class="common_container common_shadow post_form_container">
    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <label for="{{Constants::POST_COLUMN_TITLE}}" class="post_form_label">タイトル</label>
    <input type="text" name="{{Constants::POST_COLUMN_TITLE}}" id="{{Constants::POST_COLUMN_TITLE}}" class="post_form_input" required value="{{ old(Constants::POST_COLUMN_TITLE, $post->title ?? '') }}">

    <label for="{{Constants::POST_COLUMN_DETAIL}}" class="post_form_label">詳細</label>
    <textarea name="{{Constants::POST_COLUMN_DETAIL}}" id="{{Constants::POST_COLUMN_DETAIL}}" rows="5" class="post_form_textarea" required>{{ old(Constants::POST_COLUMN_DETAIL, $post->detail ?? '') }}</textarea>

    <input type="submit" class="common_button post_form_submit_button" value="{{ $buttonText }}">

</form>
