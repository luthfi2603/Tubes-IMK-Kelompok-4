<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik RH61</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    {{-- <script src="{{ asset('assets/js/custom-check.js') }}"></script> --}}
</head>
<body class="bg-[#E3EBF3] dark:bg-slate-800 min-h-screen flex flex-col items-center">
    <div class="mx-auto">
        <div class="flex items-center justify-center mb-1">
            <img class="size-52 md:size-64 mx-auto" src="{{ asset('assets/img/logo.png') }}" />
        </div>
        <div class="text-center mb-4">
            <div class="text-zinc-900 dark:text-white text-xl md:text-2xl font-bold leading-[38px]">Mari bergabung bersama kami</div>
            <div class="text-neutral-400 dark:text-slate-50 text-base md:text-lg font-semibold">Silakan pilih pengguna untuk melanjutkan</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mb-8">
            <!-- Patient Card -->
            <a href="{{ route('login') }}" class="cursor-pointer bg-neutral-100 rounded-[18px] p-4 flex items-center space-x-4 hover:bg-[#bbbbbb] mx-auto">
                <div class="size-16 bg-blue-950 rounded-[13px] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-blue-950 text-lg font-medium">Sebagai pasien</div>
                    <div class="text-neutral-400 text-base font-medium mt-2">Pilih untuk lanjut ke halaman pasien</div>
                </div>
            </a>
            <!-- Doctor Card -->
            <a href="{{ route('login') }}" class="cursor-pointer bg-neutral-100 rounded-[18px] p-4 flex items-center space-x-4 hover:bg-[#bbbbbb] mx-auto">
                <div class="size-16 bg-white rounded-[13px] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-black w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a5.5 5.5 0 0 0 11 0v-3.5a2 2 0 0 0 -2 -2h-1" />
                        <path d="M8 15a6 6 0 1 0 12 0v-3" />
                        <path d="M11 3v2" />
                        <path d="M6 3v2" />
                        <path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-black text-lg font-medium">Sebagai dokter</div>
                    <div class="text-neutral-400 text-base font-medium mt-2">Pilih untuk lanjut ke halaman dokter</div>
                </div>
            </a>
            <!-- Nurse Card -->
            <a href="{{ route('login') }}" class="cursor-pointer bg-neutral-100 rounded-[18px] p-4 flex items-center space-x-4 hover:bg-[#bbbbbb] mx-auto">
                <div class="size-16 bg-blue-950 rounded-[13px] flex items-center justify-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  class="text-white w-10"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-nurse">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 6c2.941 0 5.685 .847 8 2.31l-2 9.69h-12l-2 -9.691a14.93 14.93 0 0 1 8 -2.309z" />
                        <path d="M10 12h4" />
                        <path d="M12 10v4" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-black text-lg font-medium">Sebagai perawat</div>
                    <div class="text-neutral-400 text-base font-medium mt-2">Pilih untuk lanjut ke halaman perawat</div>
                </div>
            </a>
            <!-- Admin Card -->
            <a href="{{ route('login') }}" class="cursor-pointer bg-neutral-100 rounded-[18px] p-4 flex items-center space-x-4 hover:bg-[#bbbbbb] mx-auto">
                <div class="size-16 bg-white rounded-[13px] flex items-center justify-center">
                    <svg  xmlns="http://www.w3.org/2000/svg"  class="text-black w-10"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-desktop-analytics">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                        <path d="M7 20h10" />
                        <path d="M9 16v4" />
                        <path d="M15 16v4" />
                        <path d="M9 12v-4" />
                        <path d="M12 12v-1" />
                        <path d="M15 12v-2" />
                        <path d="M12 12v-1" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-black text-lg font-medium">Sebagai Admin</div>
                    <div class="text-neutral-400 text-base font-medium mt-2">Pilih untuk lanjut ke halaman admin</div>
                </div>
            </a>
        </div>
        <div class="justify-center my-8 hidden">
            <a href="{{ route('login') }}" class="bg-[#222C67] hover:bg-[#525985] text-[#f5f5f5] font-bold py-2 px-4 border-b-4 border-[#222C67] hover:border-[#525985] rounded font-body">
                Lanjutkan
            </a>
        </div>
    </div>
</body>
</html>