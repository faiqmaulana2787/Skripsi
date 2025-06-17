<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="website icon" type="png" href="{{ asset('img/logo_ecc.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
</head>

<body class="bg-gray-50">
    <!-- Form Login -->
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
            <div class="flex justify-center items-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('img/logo_ecc.png') }}" alt="logo_rrq" class="h-16 w-16" />
                </a>
            </div>
            @if (session('loginError'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('loginError') }}
                </div>
            @endif
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

            <form action="login" method="POST">
                <!-- Username Field -->
                @csrf
                <div class="mb-4">
                    <label for="no_peserta" class="block text-gray-700 font-medium mb-2">No Peserta</label>
                    <input type="no_peserta" id="no_peserta" name="no_peserta" placeholder="Masukkan No Peserta Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yetext-green-400 focus:border-yetext-green-400 outline-none" />
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Passwornd Anda"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yetext-green-400 focus:border-yetext-green-400 outline-none" />
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit"
                        class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Form Login -->
</body>

</html>
