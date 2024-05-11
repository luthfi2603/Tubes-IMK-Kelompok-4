@extends('layouts.main')

@section('container')
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Informasi</p>
    <div class="border-gray-300 rounded-2xl flex border-4 md:max-w-[720px]">
        <div class="w-1/6 flex">
            <svg class="w-2 h-2 fill-gray-300 m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
        </div>
        <div class="w-full py-2 pr-2 md:text-lg">
            Janji temu Anda dengan <b>Dr. Lorem Ipsum</b> pada hari <b>Senin 1 Januari pukul 09:00</b> telah berhasil dipesan
        </div>
    </div>
    <div class="border-red-300 rounded-2xl flex border-4 md:max-w-[720px]">
        <div class="w-1/6 flex">
            <svg class="w-2 h-2 fill-red-300 m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
        </div>
        <div class="w-full py-2 pr-2 md:text-lg">
            Kamu berhasil membatalkan janji temu dengan <b>Dr. Lorem Ipsum</b> pada hari <b>Senin 1 Januari pukul 09:00</b>
        </div>
    </div>
    <div class="border-green-300 rounded-2xl flex border-4 md:max-w-[720px]">
        <div class="w-1/6 flex">
            <svg class="w-2 h-2 fill-green-300 m-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
        </div>
        <div class="w-full py-2 pr-2 md:text-lg">
            Janji temu Anda dengan <b>Dr. Lorem Ipsum</b> pada hari <b>Senin 1 Januari pukul 09:00</b> telah berhasil dilakukan
        </div>
    </div>
</div>
@endsection