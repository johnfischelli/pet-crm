<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-pink-200 flex justify-center py-6">
        @yield('content')
    </body>
</html>
