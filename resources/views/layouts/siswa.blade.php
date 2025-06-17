<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Education Center Class | Siswa Panel</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_ecc.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-x-4">
                    <img src="{{ asset('img/logo_ecc.png') }}" alt="logo" class="h-12">
                    <div class="hidden md:block">
                        <h1 class="text-xl font-bold">Education Center Class</h1>
                        <p class="text-sm">Perumahan Griya Lawu, Jln. Lawu Raya No. 08, Ngawi</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex space-x-6 items-center">
                    <div class="hidden md:flex space-x-6 items-center">
                        <x-siswa-nav-link route="dashboard2" label="Dashboard" icon="fas fa-tachometer-alt" />
                        <x-siswa-nav-link route="ujian.lainnya" label="Ujian" icon="fas fa-file-alt" />
                        <x-siswa-nav-link route="konsultasi.lainnya" label="Konsultasi" icon="fas fa-comments" />
                        <x-siswa-nav-link route="siswa.profile" label="Profil" icon="fas fa-user" />

                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-gray-600 hover:text-red-600 transition font-medium flex items-center space-x-2">
                                    <i class="fas fa-sign-out-alt fa-flip-horizontal"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden bg-white shadow px-4 pb-4 space-y-2" x-show="open" x-transition>
            <x-siswa-nav-link route="dashboard2" label="Dashboard" icon="fas fa-tachometer-alt" />
            <x-siswa-nav-link route="ujian.lainnya" label="Ujian" icon="fas fa-file-alt" />
            <x-siswa-nav-link route="konsultasi.lainnya" label="Konsultasi" icon="fas fa-comments" />
            <x-siswa-nav-link route="siswa.profile" label="Profil" icon="fas fa-user" />
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left text-gray-600 hover:text-red-600 flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt fa-flip-horizontal"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">
            @yield('content')
        </div>
    </main>

</body>

</html>
