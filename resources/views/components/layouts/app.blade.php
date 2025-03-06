<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link type="image/png" sizes="16x16" rel="icon" href="{{ asset('images/icons8-dog-16.png') }}">

    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body>
    <x-alertas />
    {{ $slot }}

    @if (!Auth::check())
        @include('login')        
    @endif    
</body>

</html>
