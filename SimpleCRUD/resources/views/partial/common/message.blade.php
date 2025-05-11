{{-- すべての成功、エラーメッセージを表示する --}}

{{-- success と error のメッセージを順番に処理する --}}
@foreach (['success', 'error'] as $messageType)
    {{-- sessionにメッセージが存在するかを確認する --}}
    {{-- ※確認しないと、メッセージがないものに対してforeachを実行しようとしてエラーとなる --}}
    @if (!session($messageType))
        {{-- メッセージが存在しないため、表示する処理を行わない。 --}}
        @continue
    @endif

    {{-- 各メッセージをループ処理 --}}
    @foreach (session($messageType) as $message)
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

{{-- success と error のメッセージを順番に処理する --}}
@foreach ($errors->all() as $error)
    <div class="common_alert common_alert_error">
        {{-- メッセージを表示する--}}
        {{ $error }} 
    </div>
@endforeach