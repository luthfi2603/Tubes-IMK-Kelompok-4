@extends('layouts.main')

@section('container')

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
                    <h2 class="text-2xl font-semibold font-body text-white pt-2 pb-1">{{ auth()->user()->perawat->nama }}</h2>
                    <p class="text-white">Perawat</p>
                    <p class="pt-3 pb-1">Hari ini terdapat<span class="font-bold text-[#E8C51C]"> {{ $jumlahReservasi }} Reservasi</span></p>
                </div>
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/img/staff.png') }}" alt="Doctor Avatar"
                        class="w-full h-40 lg:block md:block max-[760px]:hidden">
                </div>
            </div>
        </div>
        <div class="mt-6">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Laporan</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 dark:bg-[#374151] p-4 rounded-lg flex flex-col items-center space-y-2 col-span-3">
                        <div class="text-4xl font-bold text-blue-800 dark:text-white">{{ $jumlahPasien }}</div>
                        <div>
                            <p class="text-gray-600 dark:text-[#c7d1d9] text-center">Total Pasien</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">Reservasi Hari ini</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white dark:bg-gray-900 shadow-lg w-full overflow-x-auto pt-4">
                <div class="relative my-1 flex items-center justify-end">
                    <div class="relative inline-block text-left">
                        <a href="{{ route('index.antrian') }}" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900 shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">#</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Nama Pasien</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Jenis Kelamin</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Nama Dokter</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($antrians->isEmpty())
                                <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700"><td colspan="5" class="dark:text-gray-300 text-center py-2 text-xl">Reservasi Kosong</td></tr>
                            @else
                                @php $i = 1; @endphp
                                @foreach($antrians as $item)
                                    <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-2 text-gray-900 dark:text-gray-300">{{ $i }}</td>
                                        <td class="py-2 text-gray-900 dark:text-gray-300">{{ $item->nama_pasien }}</td>
                                        <td class="py-2 text-gray-900 dark:text-gray-300">{{ $item->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                                        <td class="py-2 text-gray-900 dark:text-gray-300">{{ $item->nama_dokter }}</td>
                                        <td class="py-2"><a href="{{ route('index.antrian') }}" class="text-blue-500 dark:text-blue-300">Detail</a></td>
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
                <h2 class="text-2xl font-bold text-gray-700 dark:text-white">Pasien</h2>
            </div>
        </div>
        <div class="relative w-full max-w-5xl mt-3">
            <div class="flex flex-col pb-5 px-5 rounded-xl bg-white dark:bg-gray-900 shadow-lg w-full overflow-x-auto pt-4">
                <div class="relative my-1 flex items-center justify-end">
                    <div class="relative inline-block text-left">
                        <a href="{{ route('perawat.data.pasien') }}" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-900 shadow-md">
                        <thead>
                            <tr>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300 tracking-wider">#</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300 tracking-wider">Nama</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300 tracking-wider">Alamat</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300 tracking-wider">Nomor Handphone</th>
                                <th class="py-2 text-left text-gray-600 dark:text-gray-300 tracking-wider">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pasiens->isEmpty())
                                <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700"><td colspan="5" class="dark:text-gray-300 text-center py-2 text-xl">Pasien Kosong</td></tr>
                            @else
                                @php $i = 1; @endphp
                                @foreach($pasiens as $item)
                                    <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="py-2 pr-2 text-md text-gray-900 dark:text-gray-300">{{ $i }}</td>
                                        <td class="py-2 pr-2 text-md text-gray-900 dark:text-gray-300">{{ $item->nama }}</td>
                                        <td class="py-2 pr-2 text-md text-gray-900 dark:text-gray-300">
                                            <div class="overflow-hidden w-[200px]">
                                                {{ $item->alamat }}
                                            </div>
                                        </td>
                                        <td class="py-2 pr-2 text-md text-gray-900 dark:text-gray-300">{{ $item->nomor_handphone }}</td>
                                        <td class="py-2 pr-2 text-md"><a href="{{ route('perawat.data.pasien') }}" class="text-blue-500 dark:text-blue-300">Detail</a></td>
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
        {{-- <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Patients Group</h2>
            <ul class="space-y-4">
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span
                            class="w-6 h-6 flex items-center justify-center rounded-full bg-orange-500 text-white mr-3">C</span>
                        <span>Cholesterol</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">5 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span
                            class="w-6 h-6 flex items-center justify-center rounded-full bg-purple-500 text-white mr-3">D</span>
                        <span>Diabetic</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">14 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span
                            class="w-6 h-6 flex items-center justify-center rounded-full bg-green-500 text-white mr-3">L</span>
                        <span>Low Blood Pressure</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">10 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span
                            class="w-6 h-6 flex items-center justify-center rounded-full bg-teal-500 text-white mr-3">H</span>
                        <span>Hypertension</span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-300">21 Patients</span>
                </li>
                <li class="flex justify-between items-center">
                    <div class="flex items-center">
                        <span
                            class="w-6 h-6 flex items-center justify-center rounded-full bg-blue-500 text-white mr-3">M</span>
                        <span>Malaria</span>
                    </div>
                    <span class="text-gray-500">11 Patients</span>
                </li>
            </ul>
        </div> --}}
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold mb-2 dark:text-white">Daftar Dokter</h2>
                    <div class="relative inline-block text-left">
                        <a href="{{ route('perawat.index.dokter') }}" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 mt-4">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Dokter</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($dokters as $item)
                                <tr class="bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4">
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
    </div>
</div>
@endsection