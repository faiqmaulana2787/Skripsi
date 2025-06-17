<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Center Class</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-transparent">
    <!-- Navbar -->
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
                    <li><a href="#about" class="font-semibold hover:text-green-700">Beranda</a></li>
                    <li><a href="#programs" class="font-semibold hover:text-green-700">Jadwal Ujian</a></li>
                    <li><a href="#contact" class="font-semibold hover:text-green-700">Tentang Kami</a></li>
                    <li><a href="#contact" class="font-semibold hover:text-green-700">Login</a></li>
                </ul>
            </nav>
            <!-- Hamburger Menu -->
            <button id="menu-btn" class="md:hidden text-3xl focus:outline-none">&#9776;</button>
        </div>
        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden bg-white p-4 shadow-lg">
            <ul class="flex flex-col space-y-2 text-center">
                <li><a href="#about" class="block font-semibold hover:text-green-700">Beranda</a></li>
                <li><a href="#programs" class="block font-semibold hover:text-green-700">Jadwal Ujian</a></li>
                <li><a href="#contact" class="block font-semibold hover:text-green-700">Tentang Kami</a></li>
                <li><a href="#contact" class="block font-semibold hover:text-green-700">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero relative bg-cover bg-center h-screen flex items-center justify-center text-white text-center"
        style="background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');">
        <!-- Overlay untuk Opacity -->
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        <!-- Konten agar tetap terlihat jelas -->
        <div class="relative z-10 p-6 bg-black bg-opacity-10 rounded-lg w-11/12 md:w-2/3 lg:w-1/2">
            <h2 class="text-3xl md:text-4xl font-bold">Bimbingan Belajar Education Center Class</h2>
            <p class="mt-2 text-lg md:text-2xl font-semibold">Langkah Cerdas Menuju Sukses!</p>
            <a href="#contact"
                class="mt-4 inline-block bg-green-700 text-white px-6 py-2 rounded-full font-bold hover:bg-green-500">
                Daftar Sekarang
            </a>
        </div>
    </section>

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
