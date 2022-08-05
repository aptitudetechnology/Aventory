<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Awia for Nurseries') }} | The best wholesale nursery management platform.</title>

    <!-- Icons -->
    <link rel="apple-touch-icon" href="/logos/apple-touch-icon.png">
    <link rel="icon" href="/logos/favicon.png">

    @routes

    <!-- Scripts & Styles -->
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @inertia

    {{-- @if (app()->isLocal())
        <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endif --}}
</body>

</html>
