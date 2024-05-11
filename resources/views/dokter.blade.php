@extends('layouts.main')

@section('container')
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Dokter Kami</p>
    <div class="border-gray-300 rounded-2xl flex border-4 md:max-h-[150px]">
        <div class="w-1/4 flex">
            <img src="{{ asset('./assets/img/logo.png') }}" alt="dokter" class="m-auto md:h-full">
        </div>
        <div class="w-full p-2 md:pr-9">
            <div class="md:hidden">
                <div class="border-2 border-green-500 rounded-xl w-min flex items-center gap-2 px-2">
                    <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                </div>
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
            </div>
            <div class="hidden md:flex md:gap-6">
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
                <div class="border-2 border-green-500 rounded-xl w-min flex items-center gap-2 px-2">
                    <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                </div>
            </div>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Spesialis penyakit dalam</p>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Senin-Jumat: 10:00-22:00</p>
            <div class="flex items-center mt-1 md:justify-end">
                <p class="text-blue-900 font-bold leading-none mr-3">Buat janji temu</p>
                <svg class="w-[16px] h-[16px] fill-blue-900 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
            </div>
        </div>
    </div>
    <div class="border-gray-300 rounded-2xl flex border-4 md:max-h-[150px]">
        <div class="w-1/4 flex">
            <img src="{{ asset('./assets/img/logo.png') }}" alt="dokter" class="m-auto md:h-full">
        </div>
        <div class="w-full p-2 md:pr-9">
            <div class="md:hidden">
                <div class="border-2 border-red-500 rounded-xl w-min flex items-center gap-2 px-2">
                    <svg class="w-2 h-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-red-500 font-bold mb-1 text-nowrap">tidak ada</span>
                </div>
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
            </div>
            <div class="hidden md:flex md:gap-6">
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
                <div class="border-2 border-red-500 rounded-xl w-min flex items-center gap-2 px-2">
                    <svg class="w-2 h-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-red-500 font-bold mb-1 text-nowrap">tidak ada</span>
                </div>
            </div>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Spesialis penyakit dalam</p>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Senin-Jumat: 10:00-22:00</p>
            <div class="flex items-center mt-1 md:justify-end">
                <p class="text-blue-900 font-bold leading-none mr-3">Buat janji temu</p>
                <svg class="w-[16px] h-[16px] fill-blue-900 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
            </div>
        </div>
    </div>
</div>
@endsection