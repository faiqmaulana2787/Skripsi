@extends('layouts.app')

@section('content')
    <section class="bg-white py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto bg-gray-50 p-10 rounded-2xl shadow-xl">
                <h2 class="text-3xl font-extrabold text-center text-green-600 mb-6">Hubungi Kami</h2>

                <p class="text-center text-gray-600 mb-8">
                    Jika Anda memiliki pertanyaan atau ingin informasi lebih lanjut, silakan hubungi kami melalui kontak di
                    bawah ini.
                </p>

                <div class="space-y-6 text-gray-700">
                    <div class="flex items-start gap-4">
                        <div class="text-green-500 text-2xl">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Bimbingan Belajar ECC Ngawi</h4>
                            <p>Perumahan Griya Lawu, Jl. Lawu Raya No. 08, Ngawi</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-green-500 text-2xl">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">Email</h4>
                            <a href="mailto:Bimbeleccngawi@gmail.com" target="_blank" rel="noopener noreferrer"
                                class="text-green-600 hover:underline">
                                Bimbeleccngawi@gmail.com
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="text-green-500 text-2xl">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold">WhatsApp</h4>
                            <a href="https://wa.me/6285856705444" target="_blank" rel="noopener noreferrer"
                                class="text-green-600 hover:underline">
                                0858-5670-5444
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-10 text-center">
                    <a href="https://wa.me/6285856705444" target="_blank" rel="noopener noreferrer"
                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition duration-300">
                        Kirim Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
