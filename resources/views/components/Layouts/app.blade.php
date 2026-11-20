<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'sareng|web' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <x-swal-alert />
    <x-partials.navbar />

    <div class="max-w-7xl mx-auto p-6">
        {{ $slot }}
    </div>

</body>

</html>
