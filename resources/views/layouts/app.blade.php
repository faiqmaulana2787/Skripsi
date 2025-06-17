<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="website icon" type="png" href="{{ asset('img/logo_ecc.png') }}">
    <title>Education Center Class</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-transparent text-black p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-x-4">
                <img src="{{ asset('img/logo_ecc.png') }}" alt="logo" class="h-12">
                <div class="hidden md:block">
                    <h1 class="text-xl font-bold">Education Center Class</h1>
                    <p class="text-sm">Perumahan Griya Lawu, Jln. Lawu Raya No. 08, Ngawi</p>
                </div>
            </div>
            <!-- Menu untuk Desktop -->
            <nav class="hidden md:block">
                <ul class="flex space-x-4">
                    <li><a href="{{ route('index') }}" class="font-semibold hover:text-green-700">Beranda</a></li>
                    <li><a href="{{ route('tentang') }}" class="font-semibold hover:text-green-700">Tentang Kami</a>
                    </li>
                    <li><a href="{{ route('kontak') }}" class="font-semibold hover:text-green-700">Kontak</a></li>
                    <li><a href="{{ route('login') }}" class="font-semibold hover:text-green-700">Login</a></li>
                </ul>
            </nav>
            <!-- Hamburger Menu -->
            <button id="menu-btn" class="md:hidden text-3xl focus:outline-none">&#9776;</button>
        </div>
        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden bg-white p-4 shadow-lg">
            <ul class="flex flex-col space-y-2 text-center">
                <li><a href="{{ route('index') }}" class="block font-semibold hover:text-green-700">Beranda</a></li>
                <li><a href="{{ route('tentang') }}" class="block font-semibold hover:text-green-700">Tentang Kami</a>
                </li>
                <li><a href="{{ route('kontak') }}" class="block font-semibold hover:text-green-700">Kontak</a>
                </li>
                <li><a href="{{ route('login') }}" class="block font-semibold hover:text-green-700">Login</a></li>
            </ul>
        </nav>
    </header>

    <div>
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-transparent text-black p-4 text-center">
        <p>&copy; 2025 Education Center Class. Hak Cipta Dilindungi.</p>
    </footer>
    <!-- Script untuk Toggle Mobile Menu -->
    <script>
        const menuBtn = document.getElementById("menu-btn");
        const mobileMenu = document.getElementById("mobile-menu");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>
</body>

</html>
