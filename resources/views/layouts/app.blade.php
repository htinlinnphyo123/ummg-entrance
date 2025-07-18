<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- csrf token need for using ajax post method --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.jpg') }}">
    <title>UMMG Entrance</title>
    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
</head>

<body class="dark:bg-black">
    {{ $slot }}
    <!-- Spinner element -->
    <div class="custom-spinner"></div>
</body>
</html>
