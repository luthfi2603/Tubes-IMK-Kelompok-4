@extends('dokter.main')

@section('container')

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Rekam Medis Pasien</h1>
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
            <input type="date" id="tanggal" class="border rounded p-2 w-full">
            <input type="text" placeholder="Cari nama pasien..." class="border rounded p-2 w-full">
            <button class="bg-blue-500 text-white p-2 rounded w-1/2 hover:bg-blue-600 transition duration-300 ease-in-out">Filter</button>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama Pasien</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Diagnosa</th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="isi-tabel">
                @if($rekammedis->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-2xl py-3">Data tidak ada</td>
                    </tr>
                @else
                @php
                        $halamanSekarang = request('page');
                        if(empty($halamanSekarang)){
                            $i = 1;
                        }else{
                            $i = ($halamanSekarang * 10) - 9;
                        }
                    @endphp
                @foreach($rekammedis as $rekam)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $rekam->nama_pasien }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $rekam->diagnosa }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md">
                            <a href="{{ route('dokter.rekam.medis.show', $rekam->id) }}">
                            <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                            </a>
                            <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                        </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/rekam-medis.js') }}"></script>
@endpush
@endsection
