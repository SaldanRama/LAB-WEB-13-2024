<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="bg-sky-200">
    @vite('resources/css/app.css')

    @include('partials.navbar')
    <br>
    <div>
        @include('components.message')
        @yield('content')
    </div>
    <br>
    @include('partials.footer')
</body>
</html>