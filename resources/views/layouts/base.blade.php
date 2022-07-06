<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
        @else
        <title>@yield('title', config('app.name'))</title>
        @endif
        @stack('meta')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css'])
        @stack('head_styles')

        @vite(['resources/js/app.js'])
        @stack('head_scripts')
    </head>
    <body class="antialiased h-full">
        {{ $slot }}
        @stack('body_scripts')
    </body>
</html>
