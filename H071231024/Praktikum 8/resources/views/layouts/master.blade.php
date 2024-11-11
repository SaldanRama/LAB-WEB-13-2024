<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>

    <header class="header">
        <a href="#" class="logo">&lt; &gt; Wannn. &lt;/&gt;</a>
        <nav class="navbar">
           <a href="{{ route('home') }}">Home</a>
           <a href="{{ route('about') }}">About</a>
           <a href="{{ route('contact') }}">Contact</a>
         </nav>
      </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Website Sederhana. All rights reserved.</p>
    </footer>

</body>
</html>

{{-- punya Si Mas Hitam Radinata --}}