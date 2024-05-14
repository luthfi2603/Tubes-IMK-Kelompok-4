<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik RH61</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
</head>
<body class="bg-neutral-100 min-h-screen flex flex-col items-center justify-center">
    <div class="w-full sm:w-[90%] md:w-[50%] lg:w-[40%] xl:w-[30%] 2xl:w-[25%] mx-auto p-4">
        <div class="flex items-center justify-center mb-4">
            <img class="w-full max-w-sm mx-auto" src="{{ asset('assets/img/logo.png') }}" />
        </div>

        <div class="text-center mb-8">
            <div class="text-zinc-900 text-[40px] font-bold font-['Nunito Sans'] leading-[38px]">Let's get acquainted</div>
            <div class="text-neutral-400 text-[25px] font-semibold font-['Inter'] mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec gravida libero vel euismod porttitor.</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Patient Card -->
            <div class="bg-neutral-100 rounded-[18px] p-4 flex items-center space-x-4">
                <div class="w-[99.37px] h-[104.82px] bg-blue-950 rounded-[13px] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white w-[60px] h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-blue-950 text-[25px] font-medium font-['Poppins']">I’m a patient</div>
                    <div class="text-neutral-400 text-xl font-medium font-['Inter'] mt-2">Proin convallis libero ac nisl</div>
                </div>
            </div>

            <!-- Doctor Card -->
            <div class="bg-neutral-100 rounded-[18px] p-4 flex items-center space-x-4">
                <div class="w-[99.37px] h-[104.82px] bg-white rounded-[13px] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-black w-[60px] h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a5.5 5.5 0 0 0 11 0v-3.5a2 2 0 0 0 -2 -2h-1" />
                        <path d="M8 15a6 6 0 1 0 12 0v-3" />
                        <path d="M11 3v2" />
                        <path d="M6 3v2" />
                        <path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-black text-[25px] font-medium font-['Poppins']">I’m a doctor</div>
                    <div class="text-neutral-400 text-xl font-medium font-['Inter'] mt-2">Proin convallis libero ac nisl</div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-8 mb-4">
            <button class="bg-blue-950 text-white text-[32px] font-semibold py-4 px-8 rounded-[18px]">Continue</button>
        </div>
    </div>
</body>
</html>
