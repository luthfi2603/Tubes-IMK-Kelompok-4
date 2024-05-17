@extends('layouts.main')

@section('container')
<div class="flex flex-col items-center">
    @if(session()->has('failed'))
        <div class="mt-4 bg-red-300 py-3 text-white px-9 rounded-lg">
            {{ session('failed') }}
        </div>
    @elseif(session()->has('success'))
        <div id="success" class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-2" class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg hidden"></div>
    <div id="failed" class="mt-4 bg-red-300 py-3 text-white px-9 rounded-lg hidden"></div>
    <p class="my-4 font-semibold text-xl">Verifikasi</p>
    {{-- @if(session()->all()['_previous']['url'] == 'http://127.0.0.1:8000/register') --}}
    <form id="form" class="w-9/12 md:w-1/4 flex flex-col items-center" onsubmit="return false;">
        @csrf
        <input type="hidden" name="nomor_handphone" value="{{ session()->get('request')['nomor_handphone_dimodifikasi'] }}">
        <div class="flex flex-col mb-3 w-full">
            <label for="kode_verifikasi">Kode OTP</label>
            <input type="number" name="kode_verifikasi" id="kode_verifikasi" class="@error('kode_verifikasi') bg-red-500 placeholder-white @enderror" placeholder="Masukkan kode OTP" autofocus>
            @error('kode_verifikasi')
                <div class="bg-red-300 text-white">
                    {{ $message }}
                </div>
            @enderror
            <div id="error-message" class="bg-red-300 text-white hidden"></div>
        </div>
        <p>Masukkan kode OTP dalam waktu 10 menit</p>
        <div>Waktu tersisa <span id="waktu" class="font-bold">10:00</span></div>
        <p id="kirim-ulang-2">Kirim ulang kode OTP dalam <span id="waktu-2" class="font-bold">00:30</span></p>
        <span onclick="kirimUlang('{{ csrf_token() }}', '{{ route('kirim.ulang.kode.otp.update.nomor.handphone') }}')" id="kirim-ulang" class="font-bold underline text-blue-500 cursor-pointer hidden">Kirim Ulang</span>
        <button onclick="kirim('{{ route('pasien.verifikasi') }}')" type="button" class="px-4 py-2 bg-gray-400 rounded-xl text-white mb-4 mt-3">Kirim</button>
    </form>
</div>
@push('scripts')
    <script src="{{ asset('assets/js/verifikasi.js') }}"></script>
@endpush
@endsection