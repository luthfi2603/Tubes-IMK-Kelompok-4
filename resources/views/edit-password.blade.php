@extends('layouts.main')

@section('container')
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
<div class="pb-4 flex flex-col items-center font-body">
    <div class="py-3 lg:w-96 sm:w-80 md:w-96 text-center">
        <h1 class="text-3xl font-bold mb-4">Ubah Kata Sandi Anda</h1>
        <p class="text-gray-600 text-md font-semibold">Silahkan masukkan Kata Sandi anda yang baru</p>
    </div>
    <div class="flex justify-center">
        <img src="{{ asset('assets/img/reset-password-pasien.png') }}" alt="Verification Image" class="w-64 h-full">
    </div>
    <div class="w-full flex-1">
        <div class="mx-auto max-w-md">
            <form method="POST" action="{{ route('password.edit') }}">
                @csrf
                @method('PUT')
                <div class="content-center relative">
                    <label for="old_password" class="ml-2 text-md font-bold text-gray-700 tracking-wide">Kata Sandi Lama</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="old_password" id="old_password"
                        placeholder="Masukkan kata sandi lama anda">
                    <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="toggle-password-3"></i>
                    @error('old_password')
                        <div class="text-[#B42223] text-bold text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="content-center relative mt-4">
                    <label for="password" class="ml-2 text-md font-bold text-gray-700 tracking-wide">Kata Sandi Baru</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="password" id="password"
                        placeholder="Masukkan kata sandi baru anda">
                    <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="toggle-password"></i>
                    @error('password')
                        <div class="text-[#B42223] text-bold text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="content-center relative mt-4">
                    <label for="konfirmasi_password" class="ml-2 text-md font-bold text-gray-700 tracking-wide">Konfirmasi Kata Sandi Baru</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-md focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="konfirmasi_password" id="konfirmasi_password"
                        placeholder="Masukkan konfirmasi kata sandi baru anda">
                    <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="toggle-password-2"></i>
                    @error('konfirmasi_password')
                        <div class="text-[#B42223] text-bold text-md">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit"
                    class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span class="ml-3">
                        Kirim
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('assets/js/show-password.js') }}"></script>
@endpush
@endsection
