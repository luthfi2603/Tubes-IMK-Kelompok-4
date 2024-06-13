@extends('layouts.main')

@section('container')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-[#222C67]">Rekam Medis Pasien</h1>
    </div>
    <hr class="border-1 border-[#B1B0AF] mb-8">
    @if($rekamMedis->isEmpty())
        <div class="mt-4 text-center w-full">
            <p class="text-xl font-bold">Rekam Medis Tidak Ada</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($rekamMedis as $item)
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-[#222C67] mb-2">{{ $item->nama_dokter }}</h2>
                        <p class="text-lg text-gray-600 mb-4">{{ $item->spesialis }}</p>
                        <p class="text-md text-gray-600 mb-4">Waktu Kunjungan: {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y, H:i') }}</p>
                        <p class="text-md text-gray-600">Diagnosa: {{ $item->diagnosa }}</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('rekam.medis.detail', $item->id) }}">
                            <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300">Detail</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection