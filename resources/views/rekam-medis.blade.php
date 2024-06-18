@extends('layouts.main')

@section('container')
<div class="container mx-auto p-4 mb-44">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Rekam Medis Pasien</h1>
    </div>

    <hr class="border-1 border-[#B1B0AF] dark:border-gray-700 mb-8">

    <div class="bg-[#7f89c0] text-white p-4 max-[640px]:p-3 rounded-lg flex items-center mb-6">
        <div class="flex-1">
            <p class="font-vold text-lg sm:text-md max-[640px]:text-sm">"Hidup sehat adalah pilihan, dan setiap keputusan kecil membawa kita lebih dekat ke kesehatan yang lebih baik."</p>
        </div>
        <div>
            <img src="{{ asset('assets/img/nurse-1.png') }}" alt="Doctor" class="w-25 h-24 max-[640px]:w-17 max-[640px]:h-17">
        </div>
    </div>

    @if($rekamMedis->isEmpty())
        <div class="flex justify-center items-center mt-12">
            <div class="bg-[#E3EBF3] dark:bg-gray-800 text-center p-4 rounded-lg shadow-md font-bold w-full md:w-3/4 flex flex-col md:flex-row items-center justify-center md:space-y-0 md:space-x-4">
                <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                <p class="text-xl text-[#222C67] dark:text-white">Belum ada Rekam Medis</p>
                <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="hidden md:block w-16 h-16">
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($rekamMedis as $item)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-[#222C67] dark:text-white mb-2">{{ $item->nama_dokter }}</h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">{{ $item->spesialis }}</p>
                        <p class="text-md text-gray-600 dark:text-gray-300 mb-4">Waktu Kunjungan: {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y, H:i') }}</p>
                        <p class="text-md text-gray-600 dark:text-gray-300 break-all overflow-hidden">Diagnosa:</p>
                        {{-- <textarea class="rounded-lg w-full h-[200px]">{{ $item->diagnosa }}</textarea> --}}
                        <pre class="text-wrap font-body dark:text-gray-300 overflow-hidden">{{ $item->diagnosa }}</pre>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('rekam.medis.detail', $item->id) }}">
                            <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300 dark:bg-yellow-600 dark:hover:bg-yellow-700"><i class="fa-solid fa-circle-info mr-2"></i>Detail</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
