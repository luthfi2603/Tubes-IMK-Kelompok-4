@extends('dokter.main')

@section('container')

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Rekam Medis Pasien</h1>
    </div>
    <div>
        <a href="{{ route('dokter.rekam.medis.create') }}">
            <button class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                Tambah Rekam Medis
            </button>
        </a>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] mb-5 mx-4">

<div class="container mx-auto p-4">
    <div class="flex flex-wrap justify-between items-center mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 w-full">
            <select class="border rounded p-2 w-full">
                <option>Laporan Harian</option>
                <option>Laporan Bulanan</option>
                <option>Laporan Tahunan</option>
            </select>
            <input type="date" class="border rounded p-2 w-full">
            <input type="text" placeholder="Cari nama pasien..." class="border rounded p-2 w-full">
            <button class="bg-blue-500 text-white p-2 rounded w-1/2 hover:bg-blue-600 transition duration-300 ease-in-out">Filter</button>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Penyakit</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Dokter</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">2024-05-01</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">TBC</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Dr. Sarah mdith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <a href="{{ route('dokter.detail-dokter') }}">
                        <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                        </a>
                        <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">2024-05-01</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">TBC</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Dr. Sarah mdith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <a href="{{ route('dokter.detail-dokter') }}">
                        <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                        </a>
                        <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">2024-05-01</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">TBC</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Dr. Sarah mdith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <a href="{{ route('dokter.detail-dokter') }}">
                        <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                        </a>
                        <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">2024-05-01</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">TBC</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Dr. Sarah mdith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <a href="{{ route('dokter.detail-dokter') }}">
                        <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                        </a>
                        <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">2024-05-01</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">TBC</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">Dr. Sarah mdith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-md">
                        <a href="{{ route('dokter.detail-dokter') }}">
                        <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                        </a>
                        <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4">
        <div>
            <label for="items-per-page" class="block text-md font-medium text-gray-700">Items per page:</label>
            <select id="items-per-page" name="items-per-page" class="mt-1 block py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 md:text-md rounded-md">
                <option>10</option>
                <option>20</option>
                <option>50</option>
            </select>
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 bg-gray-300 text-gray-700 rounded-lg">Previous</button>
            <button class="px-3 py-1 bg-gray-300 text-gray-700 rounded-lg">Next</button>
        </div>
    </div>
</div>

@endsection
