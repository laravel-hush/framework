<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('hush.app.title', __('hush::admin.admin-dashboard')) }}</title>
    <link rel="icon" type="image/png" href="{{ asset('vendor/hush/images/favicon.ico') }}">

    <link href="{{ asset('vendor/hush/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    @yield ('body')
</body>
</html>
