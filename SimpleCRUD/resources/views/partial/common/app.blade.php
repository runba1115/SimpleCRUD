<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'app')</title>
    <link rel="stylesheet" href="{{asset('css/common/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/common/header.css')}}">
    @yield('stylesheets')
</head>

<body>
    @include('partial/common/header')
    @yield('content')
</body>

</html>
