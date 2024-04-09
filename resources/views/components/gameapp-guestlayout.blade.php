<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <script src="https://kit.fontawesome.com/9a3579ec40.js" crossorigin="anonymous"></script>
</head>

<body class="gameapplayout-body">
<div class="">

    <!-- Page Heading -->
    @if (isset($header))
        <header class="header">
            <h1>
                {{ $header }}
            </h1>
        </header>
    @endif


    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>

</html>
