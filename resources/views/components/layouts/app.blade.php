<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('hush.app.title', 'Admin dashboard') }}</title>
</head>
<body>
    @include ('hush::components.sidebar')
    @yield ('content')
</body>
</html>