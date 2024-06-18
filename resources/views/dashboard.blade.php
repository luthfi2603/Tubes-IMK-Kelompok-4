@extends('layouts.main')

@section('container')
<!-- Dashboard Header -->

<div class="flex flex-col md:flex-row justify-between items-center mb-6 px-4 pt-4">
    <h1 class="text-3xl font-bold text-[#222c67] dark:text-white mb-4 md:mb-0">Dashboard</h1>
</div>

<hr class="border-1 border-[#B1B0AF] dark:border-gray-600 mb-6 mx-4">

<!-- Main Layout -->
<div class="flex flex-col xl:flex-row w-full p-4 space-y-6 xl:space-y-0 xl:space-x-6">
    <!-- Main Content -->
    <div class="flex-1">
        <!-- Welcome Card -->
        <div class="bg-[#222C67] dark:bg-gray-900 p-6 rounded-lg shadow-lg mb-6 xl:mb-0">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="font-body text-white mb-4 md:mb-0">
                    <h1 class="text-xl font-bold text-white py-2">Selamat Datang,</h1>
                    <h2 class="text-2xl font-semibold font-body text-white py-2">{{ auth()->user()->pasien->nama }}</h2>
                    <p class="text-white py-1 mb-4">"Ingat untuk tetap terhidrasi dan minum obat tepat waktu."</p>
                    <a href="{{ route('buat.reservasi') }}" class="bg-white font-bold dark:bg-gray-700 text-blue-600 px-4 py-2 rounded-lg">Buat Janji Temu</a>
                </div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/img/patient_illustration.png') }}" alt="Doctor Avatar" class="w-44 h-44">
                </div>
            </div>
        </div>

        <!-- Health Tips Card -->
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 mt-6 flex items-center">
            <div class="flex-shrink-0 bg-teal-100 dark:bg-teal-800 rounded-full p-3">
                <i class="fas fa-heartbeat text-teal-600 dark:text-teal-300 text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-xl font-bold text-[#222C67] dark:text-white">Tips Sehat</h3>
                <p class="text-gray-600 dark:text-gray-300">Tetap terhidrasi - Minum setidaknya 8 gelas air sehari.</p>
                <p class="text-gray-600 dark:text-gray-300">Sering berolahraga - Lakukan olahraga minimal 30 menit setiap hari.</p>
            </div>
        </div>

        <!-- Medical Records Card -->
        @if(!$rekamMedis)
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 flex items-center mt-6">
                <div class="flex-shrink-0 bg-green-100 dark:bg-green-800 rounded-full p-3">
                    <i class="fas fa-file-medical text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
                <div class="ml-4 space-y-3">
                    <h3 class="text-xl font-bold text-[#222C67] dark:text-white">Rekam Medis Terbaru</h3>
                    <p class="text-gray-600 dark:text-gray-300">Anda belum memiliki rekam medis</p>
                </div>
            </div>
        @else
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 flex items-center mt-6">
                <div class="flex-shrink-0 bg-green-100 dark:bg-green-800 rounded-full p-3">
                    <i class="fas fa-file-medical text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
                <div class="ml-4 space-y-3">
                    <h3 class="text-xl font-bold text-[#222C67] dark:text-white">Rekam Medis Terbaru</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $rekamMedis->nama_dokter }} - {{ \Carbon\Carbon::parse($rekamMedis->created_at)->translatedFormat('l, d F Y') }}</p>
                    <a href="{{ route('rekam.medis.detail', $rekamMedis->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                </div>
            </div>
        @endif

        <!-- Health Metrics Chart -->
        {{-- <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-xl font-bold text-[#222C67] mb-4">Health Metrics</h3>
            <canvas id="healthMetricsChart"></canvas>
        </div> --}}

        {{-- <!-- Appointment Statistics Chart -->
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-xl font-bold text-[#222C67] dark:text-white mb-4">Appointment Statistics</h3>
            <canvas id="appointmentStatsChart"></canvas>
        </div> --}}

        <!-- Notifications Card -->
        {{-- <div class="bg-white border-l-4 border-yellow-600 rounded-lg shadow-md p-4 flex items-center justify-between mt-6">
            <div class="flex items-center space-x-4">
                <span class="text-yellow-600 text-2xl">•</span>
                <div>
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        Your appointment with <span class="font-bold text-[#222C67] dark:text-white">dr. blabla</span> on 
                        <span class="font-bold text-[#222C67] dark:text-white">Monday 1 January at 09:00 AM</span> has been 
                        <span class="font-semibold text-yellow-600">reserved successfully</span>
                    </p>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Right Sidebar -->
    <div class="w-full xl:w-1/3 flex flex-col space-y-6">
        <!-- Appointments Card -->
        {{-- <div class="bg-white p-6 rounded-lg shadow-lg max-[1280px]:hidden">
            <div class="bg-gray-200 py-3 px-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Your Appointments</h3>
            </div>
            <hr class="border-gray-300 dark:border-gray-600">
            <div class="flex justify-center pt-3">
                <div class="w-full max-w-xs mx-auto flex justify-center">
                    <div inline-datepicker data-date="02/02/2022"></div>
                </div>
            </div>
        </div> --}}

        <!-- Upcoming Appointments Card -->
        @if($reservasis->isEmpty())
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 flex items-center">
                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-800 rounded-full p-3">
                    <i class="fas fa-calendar-check text-blue-600 dark:text-blue-300 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold text-[#222C67] dark:text-white">Janji Temu yang Akan Datang</h3>
                    <p class="text-gray-600 dark:text-gray-300 my-2">Anda belum memiliki janji temu</p>
                </div>
            </div>
        @else
            @foreach($reservasis as $item)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-800 rounded-full p-3">
                        <i class="fas fa-calendar-check text-blue-600 dark:text-blue-300 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#222C67] dark:text-white">Janji Temu yang Akan Datang</h3>
                        <p class="text-gray-600 dark:text-gray-300 my-2">{{ $item->nama_dokter }} - {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}, {{ $item->waktu_rekomendasi }}</p>
                        <span class="bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-300 text-sm font-medium px-3 py-1 rounded-lg">Menunggu</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
{{-- @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Health Metrics Chart
        const healthMetricsCtx = document.getElementById('healthMetricsChart').getContext('2d');
        const healthMetricsChart = new Chart(healthMetricsCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [
                    {
                        label: 'Blood Pressure',
                        data: [120, 125, 130, 140, 135, 125],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Glucose Levels',
                        data: [90, 95, 100, 105, 110, 100],
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Weight',
                        data: [70, 72, 75, 73, 74, 72],
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Appointment Statistics Chart
        const appointmentStatsCtx = document.getElementById('appointmentStatsChart').getContext('2d');
        const appointmentStatsChart = new Chart(appointmentStatsCtx, {
            type: 'pie',
            data: {
                labels: ['Past Appointments', 'Upcoming Appointments'],
                datasets: [{
                    label: 'Appointments',
                    data: [5, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endpush --}}
@endsection