<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title ?? 'Guest' }}</title>
</head>

<body>

    <div class="flex items-center justify-center min-h-screen ">

        {{ $slot }}

    </div>




</body>

</html>
