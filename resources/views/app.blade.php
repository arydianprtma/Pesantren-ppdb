<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Pondok Pesantren Riyadussalikin Padaherang') }}</title>
        <meta name="description" content="Official website Pondok Pesantren Riyadussalikin Padaherang. Pusat pendidikan Islam, tahfidz Al-Quran, dan pembentukan karakter santri yang berakhlakul karimah.">
        <meta name="keywords" content="pondok pesantren, riyadussalikin, padaherang, pesantren jawa barat, pendidikan islam, tahfidz al-quran, ppdb pesantren">
        <link rel="icon" href="/Logo Riyad.png" type="image/png">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="Pondok Pesantren Riyadussalikin Padaherang">
        <meta property="og:description" content="Pusat pendidikan Islam dan pembentukan karakter santri yang berakhlakul karimah di Padaherang.">
        <meta property="og:image" content="{{ asset('Logo Riyad.png') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ config('app.url') }}">
        <meta property="twitter:title" content="Pondok Pesantren Riyadussalikin Padaherang">
        <meta property="twitter:description" content="Pusat pendidikan Islam dan pembentukan karakter santri yang berakhlakul karimah di Padaherang.">
        <meta property="twitter:image" content="{{ asset('Logo Riyad.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
