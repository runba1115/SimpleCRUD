{{-- すべての成功、エラーメッセージを表示する --}}

{{-- success と error のメッセージを順番に処理する --}}
@foreach (['success', 'error'] as $messageType)
    {{-- sessionにメッセージが存在するかを確認する --}}
    {{-- ※確認しないと、メッセージがないものに対してforeachを実行しようとしてエラーとなる --}}
    @if (!session($messageType))
        {{-- メッセージが存在しないため、表示する処理を行わない。 --}}
        @continue
    @endif

    {{-- メッセージが文字列(一つしか存在しない)の場合でも配列として扱えるようにする --}}
    @php
        $messages = (array) session($messageType); // sessionが配列でない場合、強制的に配列に変換
    @endphp

    {{-- 各メッセージをループ処理 --}}
    @foreach ($messages as $message)
        <div class="common_alert 
            {{-- メッセージの種類に応じて異なるスタイルを適用する（成功：緑色 エラー：赤） --}}
            @if ($messageType == 'success') common_alert_success 
            @elseif ($messageType == 'error') common_alert_error 
            @endif">
            {{-- メッセージを表示する--}}
            {{ $message }} 
        </div>
    @endforeach
@endforeach

{{-- すべてのエラーメッセージを表示する --}}
@foreach ($errors->all() as $error)
    <div class="common_alert common_alert_error">
        {{-- メッセージを表示する--}}
        {{ $error }} 
    </div>
@endforeach