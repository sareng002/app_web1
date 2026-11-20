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

<body x-data="{
    collapsed: JSON.parse(localStorage.getItem('sidebar') ?? 'false'),
    mobileOpen: false
}" x-init="$watch('collapsed', value => localStorage.setItem('sidebar', value))">

    <x-swal-alert />

    <div class="flex min-h-screen">

        <x-partials.sidebar />

        <div class="flex-1 flex flex-col">

            <x-partials.navbar />

            <main class="p-6">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>

</html>
