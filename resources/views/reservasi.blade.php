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
    <form action="{{ route('reservasi') }}" method="POST" class="flex flex-col gap-4">
        @csrf
        <div class="flex flex-col">
            <label for="tanggal">Tanggal Reservasi</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
            <p id="informasi-hari" class="hidden"></p>
            @error('tanggal')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="spesialis">Spesialis</label>
            <select name="spesialis" id="spesialis">
                <option value="">Pilih Spesialis</option>
                @foreach($spesialis as $item)
                    <option {{ old('spesialis') === $item->spesialis ? 'selected' : '' }}>{{ $item->spesialis }}</option>
                @endforeach
            </select>
            @error('spesialis')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="dokter">Dokter</label>
            <select name="dokter" id="dokter" disabled>
                <option value="">Pilih Tanggal dan Spesialis Dulu</option>
            </select>
            @error('dokter')
                <div class="text-[#B42223] text-bold text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="bg-green-500 text-white rounded-lg py-2 mt-6">Daftar</button>
    </form>
</div>
@push('scripts')
    <script>const csrf = '{{ csrf_token() }}';</script>
    <script src="{{ asset('assets/js/reservasi.js') }}"></script>
@endpush
@endsection