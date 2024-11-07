<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>\Rafly</title>
    <link rel="stylesheet" href="{{asset('styles/H071231072.css')}}" />
</head>

<body>
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
</body>

</html>