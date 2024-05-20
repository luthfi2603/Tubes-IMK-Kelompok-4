{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
</head>
<body>
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
        <p class="my-4 font-semibold text-xl">Verifikasi</p> --}}
        {{-- @if(session()->all()['_previous']['url'] == 'http://127.0.0.1:8000/register') --}}
        {{-- <form method="POST" action="{{ route('verifikasi') }}" class="w-9/12 md:w-1/4 flex flex-col items-center" onsubmit="return false;">
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
            <span onclick="kirimUlang('{{ csrf_token() }}', '{{ route('kirim.ulang.kode.otp') }}')" id="kirim-ulang" class="font-bold underline text-blue-500 cursor-pointer hidden">Kirim Ulang</span>
            <button onclick="kirim('{{ route('verifikasi.otp.reset.password') }}')" type="button" class="px-4 py-2 bg-gray-400 rounded-xl text-white mb-4 mt-3">Kirim</button>
        </form>
    </div>
    <script src="{{ asset('assets/js/verifikasi.js') }}"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex justify-center">
            <div class="mt-12 flex flex-col items-center">
                @if(session()->has('success'))
                    <div id="success" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg w-full md:w-80">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div id="success" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg w-full md:w-80">
                        {{ session('failed') }}
                    </div>
                @endif
                <div id="success-2" class="hidden mb-4 bg-green-300 py-3 text-white px-4 rounded-lg w-full md:w-80"></div>
                <div id="failed" class="hidden mb-4 bg-red-300 py-3 text-white px-4 rounded-lg w-full md:w-80"></div>
                <h2 class="text-3xl font-bold text-[#222C67]">
                    Verifikasi 
                </h2>
                <p class="w-72 text-center mt-2 text-sm text-gray-500">Silahkan masukkan verifikasi kode yang telah dikirimkan ke nomor handphone anda</p>
                <div class="w-full flex-1 mt-8">
                    <div class="mx-auto max-w-xs">
                        <form id="form" onsubmit="return false";>
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
                                <span onclick="kirimUlang('{{ csrf_token() }}', '{{ route('kirim.ulang.kode.otp') }}')" id="kirim-ulang" class="font-bold underline text-blue-500 cursor-pointer hidden">Kirim Ulang</span>
                            </div>
                            <button onclick="kirim('{{ route('verifikasi.otp.reset.password') }}')" type="button"
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