<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Sistem Ujian</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_ecc.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex items-center justify-between py-4 px-6">
            <div class="flex items-center gap-x-4">
                <img src="{{ asset('img/logo_ecc.png') }}" alt="logo" class="h-12">
                <div class="hidden md:block">
                    <h1 class="text-xl font-bold">Education Center Class</h1>
                    <p class="text-sm">Perumahan Griya Lawu, Jln. Lawu Raya No. 08, Ngawi</p>
                </div>
            </div>
            <div class="hidden sm:block text-sm text-gray-500">
                Lembaga Kursus Education Center Class
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-6 sm:p-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-8 py-4">
        <div class="text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Sistem Ujian — Education Center Class. All rights reserved.
        </div>
    </footer>

</body>

</html>
