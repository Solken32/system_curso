<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'InnovaSoft')</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="container mx-auto mt-8 p-4">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

</body>
</html>
