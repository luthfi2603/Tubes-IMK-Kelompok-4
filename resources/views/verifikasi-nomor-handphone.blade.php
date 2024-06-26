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
                @if(session()->has('failed'))
                    <div id="failed" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-4 md:inset-x-[296px] top-4 z-[999]">
                        <i class="fa-solid fa-circle-exclamation mr-1"></i>
                        <span>{{ session('failed') }}</span>
                    </div>
                @endif
                <h2 class="text-3xl font-bold text-[#222C67]">
                    Lupa Kata Sandi
                </h2>
                <p class="mt-2 text-sm text-gray-500">Silahkan masukkan nomor handphone anda untuk diverifikasi</p>
                <div class="w-full flex-1 mt-8">
                    <div class="mx-auto max-w-xs">
                        <form method="POST" action="{{ route('verifikasi.nomor.handphone') }}">
                            @csrf
                            <div class="content-center">
                                <label for="nomor_handphone" class="ml-2 text-sm font-bold text-gray-700 tracking-wide">No Handphone</label>
                                <input
                                    class="w-full px-5 py-4 mt-2 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-400 text-sm focus:outline-none focus:border-gray-400 focus:bg-white @error('nomor_handphone') @enderror"
                                    type="number" name="nomor_handphone" value="{{ old('nomor_handphone') }}"
                                    id="nomor_handphone" placeholder="Masukkan nomor handphone anda" autofocus>
                                @error('nomor_handphone')
                                    <div class="text-[#B42223] text-bold text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button
                                class="mt-5 tracking-wide font-semibold bg-[#374280] text-gray-100 w-full py-4 rounded-lg hover:bg-[#222C67] transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                <span class="ml-3">
                                    Kirim Kode Verifikasi
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-[#E3EBF3] hidden lg:flex items-center justify-center">
            <div class="m-12 xl:m-16 w-full h-full flex items-center justify-center">
                <img src="{{ asset('assets/img/elemen-forgot-password.png') }}" class="w-100 h-auto"  alt="">
            </div>
        </div>
    </div>
    <script>
        const failed = document.getElementById('failed');

        if(failed){
            setTimeout(() => {
                failed.classList.add('hidden');
            }, 3000);
        }
    </script>
</body>
</html>