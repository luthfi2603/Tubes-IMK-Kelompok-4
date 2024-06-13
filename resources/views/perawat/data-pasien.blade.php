{{-- @extends('perawat.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold mb-0">Daftar Pasien</h1>
        <p class="mb-0">
            <a href="{{ route('perawat.tambah.pasien') }}" class="font-bold text-blue-500 hover:underline">Tambah Pasien</a>
        </p>
    </div>  
    <div class="overflow-x-auto">
        <table class="min-w-full  rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                <tr>
                    <th class="px-4 py-3 text-start">No</th>
                    <th class="px-4 py-3 text-start min-w-50">Nama</th>
                    <th class="px-4 py-3 text-start min-w-40">Nomor Telepon</th>
                    <th class="px-4 py-3 text-start min-w-50">Alamat</th>
                    <th class="px-4 py-3 text-start min-w-30">Janji Temu Selanjutnya</th>
                    <th class="px-4 py-3 text-start min-w-30">Janji Temu Terakhir</th>
                    <th class="px-4 py-3 text-start min-w-30">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @php
                    $currentPage = $pasien->currentPage();
                    $perPage = $pasien->perPage();
                    $totalItems = $pasien->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach($pasien as $datapasien)
                <tr class="bg-[#E3EBF3]">
                    <td class="px-4 py-3">{{ $startingNumber++ }}</td>
                    <td class="px-4 py-3">{{ $datapasien->nama }}</td>
                    <td class="px-4 py-3">{{ $datapasien->nomor_handphone }}</td>
                    <td class="px-4 py-3">{{ $datapasien->alamat }}</td> 
                    <td></td>          
                    <td></td>
                    <td><a href="{{ route('perawat.edit.pasien', $datapasien->nomor_handphone) }}">Edit</a>
                        
                        @if ($datapasien->aktif == 1)
                            <form action="{{ route('perawat.ban.pasien', $datapasien->nomor_handphone) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="text-red-500">Ban</button>
                            </form>
                        @else
                            <form action="{{ route('perawat.unban.pasien', $datapasien->nomor_handphone) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="text-green-500">Unban</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pasien->links() }}
        </div>
    </div>
</div>
@endsection --}}

@extends('perawat.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-4 px-4">
    <h1 class="text-3xl font-bold mb-0">Daftar Pasien</h1>
    <a href="{{ route('perawat.tambah.pasien') }}" class="font-semibold text-blue-500 hover:underline">
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Pasien
        </button>
    </a>
</div>

<hr class="border-1 border-[#B1B0AF] mb-8 mx-4">

<div class="container mx-auto px-4">
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-50">Nama</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-40">Nomor Telepon</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-50">Alamat</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-30">Janji Temu Selanjutnya</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider min-w-30">Janji Temu Terakhir</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-sm font-semibold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="">
                @php
                    $currentPage = $pasien->currentPage();
                    $perPage = $pasien->perPage();
                    $totalItems = $pasien->total();
                    $startingNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach($pasien as $datapasien)
                <tr class="bg-white hover:bg-[#d1e4f2] transition duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $startingNumber++ }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $datapasien->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $datapasien->nomor_handphone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $datapasien->alamat }}</td> 
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $datapasien->janji_temu_selanjutnya ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $datapasien->janji_temu_terakhir ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 flex space-x-2">
                        <a href="{{ route('perawat.edit.pasien', $datapasien->nomor_handphone) }}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            Edit
                        </a>
                        @if ($datapasien->aktif == 1)
                            <form action="{{ route('perawat.ban.pasien', $datapasien->nomor_handphone) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Blokir
                                </button>
                            </form>
                        @else
                            <form action="{{ route('perawat.unban.pasien', $datapasien->nomor_handphone) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded shadow hover:bg-green-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Buka Blokir
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $pasien->links() }}
        </div>
    </div>
</div>
@endsection
