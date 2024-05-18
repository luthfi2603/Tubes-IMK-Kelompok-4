@extends('layouts.main')

@section('container')



<!-- Main Content -->
<div class="pb-4 flex flex-col items-center font-body">
    @if(session()->has('failed'))
        <div class="mt-4 bg-red-300 py-3 text-white px-9 rounded-lg">
            {{ session('failed') }}
        </div>
    @elseif(session()->has('success'))
        <div id="success" class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    <div class="py-3 lg:w-96 sm:w-80 md:w-96 text-center">
        <h1 class="text-3xl font-bold mb-4">Reset Password Anda</h1>
        <p class="text-gray-600 text-md font-semibold">Silahkan masukkan Kata Sandi anda yang baru</p>
    </div>
    <div class="flex justify-center">
        <img src="{{ asset('assets/img/reset-password-pasien.png') }}" alt="Verification Image" class="w-64 h-full">
    </div>
    <div class="w-full flex-1 mt-8">
        <div class="mx-auto max-w-xs">
            <form method="POST" action="{{ route('reset.password') }}">
                @csrf
                <div class="content-center relative">
                    <label for="password" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Kata Sandi</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="password" id="password"
                        placeholder="Masukkan kata sandi baru anda" autofocus>
                    <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="toggle-password"></i>
                    @error('password')
                        <div class="text-[#B42223] text-bold text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>      
                <div class="content-center relative mt-4">
                    <label for="konfirmasi_password" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Konfirmasi Password</label>
                    <input
                        class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                        type="password" name="konfirmasi_password" id="konfirmasi_password"
                        placeholder="Masukkan konfirmasi kata sandi baru anda">
                    <i class="fas fa-eye absolute right-3 top-10 cursor-pointer" id="toggle-password-2"></i>
                    @error('konfirmasi_password')
                        <div class="text-[#B42223] text-bold text-sm">
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
    <script src="{{ asset('assets/js/verifikasi.js') }}"></script>
@endpush
@endsection