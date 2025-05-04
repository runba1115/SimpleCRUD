<header>
    <div class="container header_container">
        <div class="heder_left_element">
            <p>投稿サンプル</p>
        </div>
        <div class="header_right_element">
            @if (Auth::check())
                <p>{{ Auth::user()->name }}</p>
                <a href="{{ route('users.logout') }}">ログアウト</a>
            @else
                <a href="{{ route('users.login') }}">ログイン</a>
                <a href="{{ route('users.create') }}">登録</a>
            @endif
        </div>
    </div>
</header>
