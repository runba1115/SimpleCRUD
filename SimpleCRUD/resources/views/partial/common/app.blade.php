<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'app')</title>
    @yield('stylesheets')
</head>

<body>
    @include('partial/common/header')
    @yield('content')
</body>

</html>
