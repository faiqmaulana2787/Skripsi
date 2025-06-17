@extends('layouts.app')

@section('content')
    <section class="hero relative bg-cover bg-center h-screen flex items-center justify-center text-white text-center"
        style="background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20200907/pngtree-green-hand-drawn-blackboard-education-school-supplies-background-image_397994.jpg');">
        <!-- Overlay untuk Opacity -->
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        <!-- Konten agar tetap terlihat jelas -->
        <div class="relative z-10 p-6 bg-black bg-opacity-0 rounded-lg w-11/12 md:w-2/3 lg:w-1/2">
            <h2 class="text-3xl md:text-4xl font-bold">Bimbingan Belajar Education Center Class</h2>
            <p class="mt-2 text-lg md:text-2xl font-semibold">Langkah Cerdas Menuju Sukses!</p>
            <a href="#contact"
                class="mt-4 inline-block bg-green-700 text-white px-6 py-2 rounded-full font-bold hover:bg-green-500">
                Tentang Kami
            </a>
        </div>
    </section>
@endsection
