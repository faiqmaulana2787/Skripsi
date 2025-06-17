@extends('layouts.admin')

@section('content')
    <div class="px-6 py-10 w-full">

        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, Admin 👋</h1>
            <p class="text-gray-600 mt-1">Pantau data siswa, jurusan, dan hasil konsultasi dengan mudah.</p>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card -->
            @php
                $cards = [
                    [
                        'icon' => 'fas fa-user-graduate',
                        'label' => 'Total Siswa',
                        'count' => \App\Models\Siswa::count(),
                        'color' => 'bg-blue-600',
                    ],
                    [
                        'icon' => 'fas fa-graduation-cap',
                        'label' => 'Total Jurusan',
                        'count' => \App\Models\Jurusan::count(),
                        'color' => 'bg-green-600',
                    ],
                    [
                        'icon' => 'fas fa-university',
                        'label' => 'Total PTN',
                        'count' => \App\Models\PTN::count(),
                        'color' => 'bg-purple-600',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition duration-200">
                    <div class="flex items-center space-x-4">
                        <div class="p-4 rounded-full {{ $card['color'] }} text-white text-xl">
                            <i class="{{ $card['icon'] }}"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $card['label'] }}</h3>
                            <p class="text-sm text-gray-500">{{ number_format($card['count']) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Grafik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-12">
            <!-- Grafik Konsultasi Bulanan -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">📈 Trek Konsultasi Bulanan</h2>
                </div>
                <canvas id="konsultasiChart" height="220"></canvas>
            </div>

            <!-- Grafik Persentase Asal Sekolah -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">🏫 Persentase Asal Sekolah</h2>
                </div>
                <canvas id="sekolahChart" height="220"></canvas>
            </div>
        </div>

        <!-- Chart JS -->
        <script>
            const konsultasiChart = new Chart(document.getElementById('konsultasiChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_map(fn($b) => "Bulan $b", array_keys($konsultasiBulanan->toArray()))) !!},
                    datasets: [{
                        label: 'Jumlah Konsultasi',
                        data: {!! json_encode(array_values($konsultasiBulanan->toArray())) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#3B82F6',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const sekolahChart = new Chart(document.getElementById('sekolahChart'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($asalSekolah->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($asalSekolah->values()) !!},
                        backgroundColor: [
                            '#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#6366F1', '#3B82F6'
                        ],
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#4B5563',
                                font: {
                                    size: 12
                                }
                            }
                        }
                    }
                }
            });
        </script>

    </div>
@endsection
