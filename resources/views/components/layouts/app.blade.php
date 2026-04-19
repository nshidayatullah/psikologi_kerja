<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kuesioner Psikologi Kepmenaker' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('partials.umami')
</head>

<body class="bg-gray-50 text-gray-800 antialiased font-sans">
    {{ $slot }}
</body>

</html>
