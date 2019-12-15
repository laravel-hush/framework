<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('hush.app.title', 'Admin dashboard') }}</title>

    <link href="{{ asset('vendor/hush/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="left-side">
        @include ('hush::components.sidebar')
    </nav>

    <div class="right-side">
        @include ('hush::components.topbar')

        <div class="page-content" id="content">
            @yield ('content')
        </div>
    </div>

    <script src="{{ asset('vendor/hush/js/app.js') }}"></script>
    @yield ('js')
</body>
</html>