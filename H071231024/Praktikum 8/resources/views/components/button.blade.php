@props(['route', 'text'])

<a href="{{ route($route) }}" class="button">
    {{ $text }}
</a>
