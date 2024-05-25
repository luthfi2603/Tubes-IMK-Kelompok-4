@extends('layouts.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed-php" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Reservasi</p>
    <a href="{{ route('buat.reservasi') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg py-2 px-4 w-min text-nowrap">Buat Reservasi</a>
    @if($reservasis->isEmpty())
        <div class="mt-4 text-center">
            <p class="text-xl font-bold">Belum ada reservasi</p>
        </div>
    @else
        @foreach($reservasis as $reservasi)
            <a href="#" class="p-4 border-2 rounded-lg border-[#8E8D8B] shadow-lg">
                <div class="flex flex-col">
                    <span>
                        {{ $reservasi->nama_dokter }}
                    </span>
                    <span>
                        {{ $reservasi->spesialis }}
                    </span>
                    <span>
                        {{ $reservasi->tanggal }}, 
                        {{ $reservasi->jam }}
                    </span>
                    <span>
                        {{ $reservasi->status }}
                    </span>
                </div>
            </a>
        @endforeach
    @endif
</div>
@endsection