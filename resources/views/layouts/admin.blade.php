<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="website icon" type="png" href="{{ asset('img/logo_ecc.png') }}">
    <title>Education Center Class | Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <div class="flex min-h-screen" x-data="{ isSidebarOpen: window.innerWidth >= 768 }" @resize.window="isSidebarOpen = window.innerWidth >= 768">
        <aside
            class="w-64 bg-blue-600 text-white fixed inset-y-0 left-0 transform transition-transform duration-200 ease-in-out z-30 md:relative md:translate-x-0"
            :class="{ '-translate-x-full': !isSidebarOpen }">
            <div class="p-6">
                <h1 class="text-2xl  text-center font-bold mb-6">Admin Panel</h1>
                <nav class="space-y-4">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-3 p-2 rounded-lg transition
    {{ request()->routeIs('dashboard') ? 'bg-blue-500 font-semibold' : 'hover:bg-blue-500' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('PTN.index') }}"
                        class="flex items-center space-x-3 p-2 rounded-lg transition
    {{ request()->routeIs('PTN.*') ? 'bg-blue-500 font-semibold' : 'hover:bg-blue-500' }}">
                        <i class="fas fa-university"></i>
                        <span>Perguruan Tinggi</span>
                    </a>

                    <a href="{{ route('siswa.index') }}"
                        class="flex items-center space-x-3 p-2 rounded-lg transition
    {{ request()->routeIs('siswa.*') ? 'bg-blue-500 font-semibold' : 'hover:bg-blue-500' }}">
                        <i class="fas fa-users"></i>
                        <span>Kelola Siswa</span>
                    </a>

                    <a href="{{ route('ujian.index') }}"
                        class="flex items-center space-x-3 p-2 rounded-lg transition
    {{ request()->routeIs('ujian.*') ? 'bg-blue-500 font-semibold' : 'hover:bg-blue-500' }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Paket Soal</span>
                    </a>

                    <a href="{{ route('konsultasi.index') }}"
                        class="flex items-center space-x-3 p-2 rounded-lg transition
    {{ request()->routeIs('konsultasi.*') ? 'bg-blue-500 font-semibold' : 'hover:bg-blue-500' }}">
                        <i class="fas fa-comments"></i>
                        <span>Konsultasi</span>
                    </a>
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-blue-500 transition">
                                <i class="fas fa-sign-out-alt  fa-flip-horizontal"></i>
                                <span>Logout</span>
                            </button>

                        </form>
                    @endauth
                </nav>
            </div>
        </aside>
        <div class="container flex justify-center item-center">
            @yield('content')
        </div>
    </div>
</body>

</html>
