@extends('layouts.main')

@section('container')
<!-- Dashboard Header -->
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67] dark:text-white">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Dashboard</h1>
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] dark:border-[#4b5563] mb-4 mx-4">
<div class="flex flex-col lg:flex-row w-full p-4 space-y-6 lg:space-y-0 lg:space-x-6">
    <!-- Main Content -->
    <div class="flex-1">
        <div class="bg-[#222C67] dark:bg-gray-900 p-6 rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row justify-between items-center max-[760px]:items-start">
                <div class="font-body text-white mb-4 md:mb-0">
                    <h1 class="text-xl font-bold text-white py-2">Selamat Datang,</h1>
                    <h2 class="text-2xl font-semibold font-body text-white py-2">{{ auth()->user()->dokter->nama }}</h2>
                    <p class="text-white py-1">Spesialis {{ auth()->user()->dokter->spesialis }}</p>
                    <p class="pt-3 pb-1">Anda memiliki <span class="font-bold text-[#E8C51C]">{{ $jumlahReservasi }} Janji Temu</span> hari ini!</p>
                </div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/img/female-doctor.png') }}" alt="Doctor Avatar" class="w-40 h-40 lg:block md:block max-[760px]:hidden">
                </div>
            </div>
        </div>
        <div class="mt-8">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Laporan</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 dark:bg-[#374151] p-4 rounded-lg flex flex-col items-center space-y-2 col-span-3">
                        <div class="text-4xl font-bold text-blue-800  dark:text-white">{{ count($jumlahPasien) }}</div>
                        <div>
                            <p class="text-gray-600 dark:text-[#c7d1d9] text-center">Total Pasien</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg h-full">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Patients</h3>
                    <select class="border-gray-300 rounded-md dark:bg-[#374151] dark:text-white">
                        <option>This Week</option>
                    </select>
                </div>
                <div>
                    <canvas id="patientsChart"></canvas>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg h-full">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Gender</h3>
                    <select class="border-gray-300 rounded-md dark:bg-[#374151] dark:text-white">
                        <option>2023</option>
                    </select>
                </div>
                <canvas id="genderChart"></canvas>
            </div>
        </div> --}}
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">Reservasi Hari ini</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white dark:bg-gray-900 shadow-lg w-full overflow-x-auto pt-4 space-y-4">
                <div class="relative my-1 flex items-center justify-end">
                    <div class="relative inline-block text-left">
                        <a href="{{ route('dokter.janji.temu') }}" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900 shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">#</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Nama Pasien</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Jenis Kelamin</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Nama Dokter</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($antrians->isEmpty())
                                <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700"><td colspan="5" class="dark:text-gray-300 text-center py-2 text-xl">Reservasi Kosong</td></tr>
                            @else
                                @php $i = 1; @endphp
                                @foreach($antrians as $item)
                                    <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300">{{ $i }}</td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300">{{ $item->nama_pasien }}</td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300">{{ $item->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300">{{ $item->nama_dokter }}</td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300"><a href="{{ route('dokter.janji.temu') }}" class="text-blue-500">Detail</a></td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">Rekam Medis Hari Ini</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white dark:bg-gray-900 shadow-lg w-full overflow-x-auto pt-4 space-y-4">
                <div class="relative my-1 flex items-center justify-end">
                    <div class="relative inline-block text-left">
                        <a href="{{ route('dokter.rekam.medis') }}" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900 shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">#</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Nama Pasien</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Diagnosa</th>
                                <th class="py-2 pr-2 text-left text-gray-600 dark:text-gray-300">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rekamMedis->isEmpty())
                                <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700"><td colspan="4" class="dark:text-gray-300 text-center py-2 text-xl">Rekam Medis Kosong</td></tr>
                            @else
                                @php $i = 1; @endphp
                                @foreach($rekamMedis as $item)
                                    <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300">{{ $i }}</td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300">{{ $item->nama_pasien }}</td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300"><textarea class="rounded-lg">{{ $item->diagnosa  }}</textarea></td>
                                        <td class="py-2 pr-2 text-gray-900 dark:text-gray-300"><a href="{{ route('dokter.rekam.medis.show', $item->id) }}" class="text-blue-500">Detail</a></td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Right Sidebar -->
    <div class="w-full lg:w-1/3">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold mb-2 dark:text-white">Daftar Dokter</h2>
                    <div class="relative inline-block text-left">
                        <a href="{{ route('dokter.dokter.kami') }}" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium dark:text-gray-300 text-gray-500 uppercase tracking-wider">Nama Dokter</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($dokters as $item)
                                <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->nama }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->spesialis }}</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="bg-white mb-6 w-full pb-4">
            <div class="bg-gray-200 py-3 px-4 rounded-t-lg">
                <h3 class="text-lg font-semibold">Your Appointments</h3>
            </div>
            <hr class="border-gray-300">
            <div class="flex justify-center pb-6 pt-3">
                <div class="w-full max-w-xs mx-auto flex justify-center">
                    <div inline-datepicker data-date="02/02/2022"></div>
                </div>
            </div>
        </div> --}}
        {{-- <div>
            <div class="flex items-center justify-between bg-blue-100 p-3 rounded-lg mb-2">
                <div>
                    <h4 class="font-semibold">Brian Matthew Ufi</h4>
                    <p class="text-gray-600">10:00 am - 11:00 am</p>
                </div>
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
                </a>
            </div>
            <div class="flex items-center justify-between bg-red-100 p-3 rounded-lg mb-2">
                <div>
                    <h4 class="font-semibold">Brian Matthew Ufi</h4>
                    <p class="text-gray-600">10:00 am - 11:00 am</p>
                </div>
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
                </a>
            </div>
            <div class="flex items-center justify-between bg-yellow-100 p-3 rounded-lg mb-2">
                <div>
                    <h4 class="font-semibold">Brian Matthew Ufi</h4>
                    <p class="text-gray-600">10:00 am - 11:00 am</p>
                </div>
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
                </a>
            </div>
            <div class="flex items-center justify-between bg-green-100 p-3 rounded-lg mb-2">
                <div>
                    <h4 class="font-semibold">Brian Matthew Ufi</h4>
                    <p class="text-gray-600">10:00 am - 11:00 am</p>
                </div>
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
                </a>
            </div>
            <div class="text-center mt-4 rounded-lg w-full">
                <button class="p-2 bg-gray-300 rounded-lg">View All Appointments</button>
            </div>
        </div> --}}
    </div>
</div>
{{-- @push('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx1 = document.getElementById('patientsChart').getContext('2d');
        const ctx2 = document.getElementById('genderChart').getContext('2d');

        const patientsChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6'],
                datasets: [
                    {
                        label: 'Men',
                        data: [150, 120, 180, 70, 90, 160, 80],
                        borderColor: 'rgba(59, 130, 246, 1)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                    },
                    {
                        label: 'Women',
                        data: [100, 110, 130, 90, 80, 70, 50],
                        borderColor: 'rgba(252, 165, 165, 1)',
                        backgroundColor: 'rgba(252, 165, 165, 0.1)',
                        fill: true,
                    },
                ],
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
                        beginAtZero: true,
                    },
                },
            },
        });

        const genderChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Men', 'Women'],
                datasets: [
                    {
                        label: 'Gender',
                        data: [170, 140],
                        backgroundColor: ['rgba(59, 130, 246, 1)', 'rgba(252, 165, 165, 1)'],
                    },
                ],
            },
            options: {
                responsive: true,
            },
        });
    </script>
@endpush --}}
@endsection