<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Public Pages')</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold text-xl">Lab IT</a>

            <div class="flex gap-6">
                <a href="/" class="hover:text-blue-600">Home</a>
                <a href="/katalog" class="hover:text-blue-600">Katalog Aset</a>
                <a href="/panduan" class="hover:text-blue-600">Panduan KMS</a>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-white shadow p-4 mt-10">
        <div class="container mx-auto text-center text-sm text-gray-600">
            &copy; {{ date('Y') }} Lab IT — All rights reserved.
        </div>
    </footer>

</body>
</html>
