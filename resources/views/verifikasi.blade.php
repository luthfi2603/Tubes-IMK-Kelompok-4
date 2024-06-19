<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="shortcut icon" href="{{ asset('./assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex justify-center">
            <div class="mt-12 flex flex-col items-center">
                @if(session()->has('success'))
                    <div id="success" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-4 md:inset-x-[296px] top-4 z-[999]">
                        <i class="fa-regular fa-circle-check mr-1"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @elseif(session()->has('failed'))
                    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-4 md:inset-x-[296px] top-4 z-[999]">
                        <i class="fa-solid fa-circle-exclamation mr-1"></i>
                        <span>{{ session('failed') }}</span>
                    </div>
                @endif
                <div id="success-2" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-4 md:inset-x-[296px] top-4 z-[999] hidden">
                    <i class="fa-regular fa-circle-check mr-1"></i>
                    <span></span>
                </div>
                <div id="failed" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-4 md:inset-x-[296px] top-4 z-[999] hidden">
                    <i class="fa-solid fa-circle-exclamation mr-1"></i>
                    <span></span>
                </div>
                <h2 class="text-3xl font-bold text-[#222C67]">
                    Verifikasi 
                </h2>
                <p class="w-72 text-center mt-2 text-sm text-gray-500">Silahkan masukkan verifikasi kode yang telah dikirimkan ke nomor handphone anda</p>
                <div class="w-full flex-1 mt-8">
                    <div class="mx-auto max-w-xs">
                        <form id="form" onsubmit="kirim('{{ route('verifikasi') }}', event)">
                            @csrf
                            <input type="hidden" name="nomor_handphone" value="{{ session()->get('request')['nomor_handphone_dimodifikasi'] }}">
                            <div class="content-center">
                                <label for="kode_verifikasi" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">Kode OTP</label>
                                <input
                                    class="w-full px-5 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('kode_verifikasi') @enderror"
                                     type="number" placeholder="Masukkan Kode OTP"
                                     autofocus name="kode_verifikasi" id="kode_verifikasi" >
                                @error('kode_verifikasi')
                                    <div class="text-[#B42223] text-bold text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div id="error-message" class="text-[#B42223] hidden"></div>
                            </div>
                            <div class="text-md mb-2">
                                <p class="mt-5 mb-1">Masukkan kode OTP dalam waktu 10 menit</p>
                                <div class="my-1">Waktu tersisa <span id="waktu" class="font-bold">10:00</span></div>
                                <p id="kirim-ulang-2">Kirim ulang kode OTP dalam <span id="waktu-2" class="font-bold my-1">00:30</span></p>
                                <span onclick="kirimUlang('{{ csrf_token() }}', '{{ route('kirim.ulang.kode.otp') }}')" id="kirim-ulang" class="font-bold underline text-blue-500 cursor-pointer hidden">Kirim Ulang</span>
                            </div>
                            <button class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span class="ml-3">Kirim</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-[#E3EBF3] hidden lg:flex items-center justify-center">
            <div class="m-12 xl:m-16 w-full h-full flex items-center justify-center">
                <img src="{{ asset('assets/img/elemen-reset-password.png') }}" class="w-100 h-auto"  alt="">
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/verifikasi.js') }}"></script>
</body>
</html>