<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title ?? 'Guest' }}</title>
</head>

<body class="bg-slate-100">

    <div class="min-h-screen flex items-center justify-center">

        {{ $slot }}

    </div>

</body>

</html>
