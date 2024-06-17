@extends('layouts.main')

@section('container')

@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] dark:bg-green-800  text-[#0f5132] dark:text-green-100  border-2 border-[#badbcc] dark:border-green-600 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] dark:bg-red-800 text-[#842029] border-2 border-[#f5c2c7] dark:text-red-100 dark:border-red-600 px-4 py-3 rounded-lg fixed z-[999] inset-x-6 md:inset-x-[296px]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif
<div id="success-2" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-6 md:inset-x-[296px] z-[999] hidden">
    <i class="fa-regular fa-circle-check mr-1"></i>
    <span></span>
</div>
<div id="failed" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-6 md:inset-x-[296px] z-[999] hidden">
    <i class="fa-solid fa-circle-exclamation mr-1"></i>
    <span></span>
</div>
<div class="pb-4 flex flex-col items-center font-body">
    <div class="py-3 lg:w-96 sm:w-80 md:w-96 text-center">
        <h1 class="text-3xl font-bold text-[#222C67] dark:text-white mb-4">Verifikasi No HP</h1>
        <p class="text-gray-600 dark:text-gray-300 text-md font-semibold">Silahkan masukkan Kode OTP yang telah terkirim ke nomor handphone yang baru</p>
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
                    <label for="kode_verifikasi" class="ml-2 text-sm font-bold text-gray-700 dark:text-gray-300 tracking-wide">Kode OTP</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-300 text-sm focus:outline-none focus:border-gray-400 focus:bg-white dark:focus:bg-gray-600 @error('kode_verifikasi') @enderror"
                         type="number" placeholder="Masukkan Kode OTP"
                         autofocus name="kode_verifikasi" id="kode_verifikasi" >
                    @error('kode_verifikasi')
                        <div class="bg-red-300 dark:bg-red-800 text-white">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="error-message" class="text-[#B42223] hidden"></div>
                </div>
                <div class="text-md mb-2">
                    <p class="mt-5 mb-1 dark:text-gray-300">Masukkan kode OTP dalam waktu 10 menit</p>
                    <div class="my-1 dark:text-gray-300">Waktu tersisa <span id="waktu" class="font-bold">10:00</span></div>
                    <p id="kirim-ulang-2" class="dark:text-gray-300">Kirim ulang kode OTP dalam <span id="waktu-2" class="font-bold my-1">00:30</span></p>
                    <span onclick="kirimUlang('{{ csrf_token() }}', '{{ route('kirim.ulang.kode.otp.update.nomor.handphone') }}')" id="kirim-ulang" class="font-bold underline text-blue-500 dark:text-blue-300 cursor-pointer hidden">Kirim Ulang</span>
                </div>
                <button onclick="kirim('{{ route('pasien.verifikasi') }}')" type="button"
                    class="mt-5 tracking-wide font-semibold bg-[#374280] dark:bg-gray-800 text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] dark:hover:bg-gray-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span class="ml-3">
                        Kirim
                    </span>
                </button>
                <button onclick="batal('{{ csrf_token() }}')" type="button" class="mt-5 tracking-wide font-semibold bg-red-500 dark:bg-red-700 text-gray-100 w-full py-4 rounded-lg hover:bg-red-600 dark:hover:bg-red-800 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
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
