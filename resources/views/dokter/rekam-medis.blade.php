@extends('layouts.main')

@section('container')
@if(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
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
                @if($rekamMedis->isEmpty())
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
                    @foreach($rekamMedis as $rekam)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $i }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                                @if($rekam->foto)
                                    <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                        <img src="{{ asset('storage/' . $rekam->foto) }}" alt="pasien" class="object-cover object-top w-full h-full">
                                    </div>
                                @else
                                    <div class="w-20 h-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">{{ $rekam->nama_pasien }}</td>
                            <td class="px-6 py-4 text-md text-gray-900">
                                <textarea class="rounded-lg h-40">{{ $rekam->diagnosa }}</textarea>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-md">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('dokter.rekam.medis.show', $rekam->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg w-full text-center">
                                        Detail
                                    </a>
                                    <a href="{{ route('dokter.rekam.medis.edit', $rekam->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg w-full text-center">
                                        Ubah
                                    </a>
                                    <form onsubmit="hapusRekamMedis(event)" method="POST" action="{{ route('dokter.rekam.medis.destroy', $rekam->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-[#b02126] rounded-lg w-full py-1 px-3 text-white">Hapus</button>
                                    </form>
                                </div>
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