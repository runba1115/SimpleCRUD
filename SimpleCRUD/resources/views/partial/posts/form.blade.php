<!-- エラーメッセージ -->
@if ($errors->any())
    <div class="post_form_error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- 投稿フォーム -->
<form action="{{ $formAction }}" method="POST" class="common_container common_shadow post_form_container">
    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <label for="title" class="post_form_label">タイトル</label>
    <input type="text" name="title" id="title" class="post_form_input" required value="{{ old('title', $post->title ?? '') }}">

    <label for="detail" class="post_form_label">詳細</label>
    <textarea name="detail" id="detail" rows="5" class="post_form_textarea" required>{{ old('detail', $post->detail ?? '') }}</textarea>

    <button type="submit" class="common_button post_form_submit_button">{{ $buttonText }}</button>
</form>
