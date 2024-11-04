<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rosé BLACKPINK</title>
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}" />

  </head>
  <body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
    
  </body>
</html>
