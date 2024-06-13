{{-- @extends('admin.main')

@section('container')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Daftar karyawan</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full  rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                <tr>
                    <th class="px-4 py-3 text-start">No</th>
                    <th class="px-4 py-3 text-start min-w-50">Nama</th>
                    <th class="px-4 py-3 text-start min-w-40">Nomor Telepon</th>
                    <th class="px-4 py-3 text-start min-w-50">Alamat</th>
                    <th class="px-4 py-3 text-start min-w-50">Jabatan</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @php
                    $currentPage = $karyawan->currentPage();
                    $perPage = $karyawan->perPage();
                    $totalItems = $karyawan->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach($karyawan as $dataKaryawan)
                <tr class="bg-[#E3EBF3]">
                    <td class="px-4 py-3">{{ $startingNumber++ }}</td>
                    <td class="px-4 py-3">{{ $dataKaryawan->nama }}</td>
                    <td class="px-4 py-3">{{ $dataKaryawan->nomor_handphone }}</td>
                    <td class="px-4 py-3">{{ $dataKaryawan->alamat }}</td>    
                    <td class="px-4 py-3">{{ $dataKaryawan->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $karyawan->links() }}
    </div>
</div>
@endsection --}}

@extends('admin.main')

@section('container')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold">Daftar karyawan</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Dokter
        </button>
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-8">

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full rounded-lg">
            <thead class="bg-gray-50 text-gray-800 text-sm font-semibold shadow">
                <tr>
                    <th class="px-4 py-3 text-start">No</th>
                    <th class="px-4 py-3 text-start min-w-50">Nama</th>
                    <th class="px-4 py-3 text-start min-w-40">Nomor Telepon</th>
                    <th class="px-4 py-3 text-start min-w-50">Alamat</th>
                    <th class="px-4 py-3 text-start min-w-50">Jabatan</th>
                    <th class="px-4 py-3 text-start min-w-40">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @php
                    $currentPage = $karyawan->currentPage();
                    $perPage = $karyawan->perPage();
                    $totalItems = $karyawan->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach($karyawan as $dataKaryawan)
                <tr class="bg-[#E3EBF3] hover:bg-[#d1e4f2] transition duration-200">
                    <td class="px-4 py-3">{{ $startingNumber++ }}</td>
                    <td class="px-4 py-3">{{ $dataKaryawan->nama }}</td>
                    <td class="px-4 py-3">{{ $dataKaryawan->nomor_handphone }}</td>
                    <td class="px-4 py-3">{{ $dataKaryawan->alamat }}</td>    
                    <td class="px-4 py-3">{{ $dataKaryawan->status }}</td>
                    <td class="px-4 py-3 flex space-x-2">
                        <button class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            Edit
                        </button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $karyawan->links() }}
        </div>
    </div>
</div>
@endsection
