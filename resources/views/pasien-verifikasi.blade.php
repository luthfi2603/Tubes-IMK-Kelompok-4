@extends('layouts.main')

@section('container')
{{-- <div class="flex flex-col items-center">
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
    {{-- <form id="form" class="w-9/12 md:w-1/4 flex flex-col items-center" onsubmit="return false;">
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
</div> --}}

@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div id="success-2" class="bg-green-300 py-3 text-white px-4 rounded-lg hidden"></div>
<div id="failed" class="bg-red-300 py-3 text-white px-4 rounded-lg hidden"></div>
<div class="pb-4 flex flex-col items-center font-body">
    <div class="py-3 lg:w-96 sm:w-80 md:w-96 text-center">
        <h1 class="text-3xl font-bold mb-4">Verifikasi No HP</h1>
        <p class="text-gray-600 text-md font-semibold">Silahkan masukkan Kode OTP yang telah terkirim ke nomor handphone yang baru</p>
    </div>
    <div class="flex justify-center">
        <img src="{{ asset('assets/img/phone-verification.png') }}" alt="Verification Image" class="w-64 h-full">
    </div>
    <div class="w-full flex-1">
        <div class="mx-auto max-w-xs">
            <form id="form" onsubmit="return false;">
                @csrf
                <input type="hidden" name="nomor_handphone" value="{{ session()->get('request')['nomor_handphone_dimodifikasi'] }}">
                <div class="content-center">
                    <label for="kode_verifikasi" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Kode OTP</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('kode_verifikasi') @enderror"
                         type="number" placeholder="Masukkan Kode OTP"
                         autofocus name="kode_verifikasi" id="kode_verifikasi" >
                    @error('kode_verifikasi')
                        <div class="bg-red-300 text-white">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="error-message" class="text-[#B42223] hidden"></div>
                </div>
                <div class="text-md mb-2">
                    <p class="mt-5 mb-1">Masukkan kode OTP dalam waktu 10 menit</p>
                    <div class="my-1">Waktu tersisa <span id="waktu" class="font-bold">10:00</span></div>
                    <p id="kirim-ulang-2">Kirim ulang kode OTP dalam <span id="waktu-2" class="font-bold my-1">00:30</span></p>
                    <span onclick="kirimUlang('{{ csrf_token() }}', '{{ route('kirim.ulang.kode.otp.update.nomor.handphone') }}')" id="kirim-ulang" class="font-bold underline text-blue-500 cursor-pointer hidden">Kirim Ulang</span>
                </div>
                <button onclick="kirim('{{ route('pasien.verifikasi') }}')" type="button"
                    class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span class="ml-3">
                        Kirim
                    </span>
                </button>
                <button onclick="batal('{{ csrf_token() }}')" type="button" class="mt-5 tracking-wide font-semibold bg-red-500 text-gray-100 w-full py-4 rounded-lg hover:bg-red-600 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <i class="fa-solid fa-xmark"></i>
                    <span class="ml-3">
                        Batal
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/js/verifikasi.js') }}"></script>
@endpush
@endsection