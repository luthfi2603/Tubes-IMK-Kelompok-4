@extends('layouts.main')

@section('container')
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Dokter Kami</p>
    @if($dokters->isEmpty())
        <div class="mt-4 text-center">
            <p class="text-xl font-bold">Dokter tidak ada</p>
        </div>
    @else
        @foreach($dokters as $item)
            <div class="border-gray-300 rounded-2xl flex border-4">
                <div class="w-1/4 flex">
                    @if($item->foto)
                        <img src="{{ asset('./assets/img/logo.png') }}" alt="dokter" class="m-auto md:h-full md:max-h-44">
                    @else
                        <svg class="m-auto md:h-full md:max-h-44" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    @endif
                </div>
                <div class="w-full p-2 md:pr-9">
                    <div class="md:hidden">
                        <div class="border-2 border-green-500 rounded-xl w-min flex items-center gap-2 px-2">
                            <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                            <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                        </div>
                        <p class="font-bold md:text-xl">{{ $item->nama }}</p>
                    </div>
                    <div class="hidden md:flex md:gap-6">
                        <p class="font-bold md:text-xl">{{ $item->nama }}</p>
                        <div class="border-2 border-green-500 rounded-xl w-min flex items-center gap-2 px-2">
                            <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                            <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                        </div>
                    </div>
                    <p class="text-gray-500 leading-tight md:text-lg md:leading-6">{{ $item->spesialis }}</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Senin</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Senin')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Senin')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Selasa</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Selasa')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>      
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Selasa')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Rabu</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Rabu')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>      
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Rabu')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Kamis</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Kamis')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>      
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Kamis')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Jumat</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Jumat')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>      
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Jumat')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Sabtu</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Sabtu')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>      
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Sabtu')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg">
                            <span class="leading-tight">Minggu</span>
                            <div class="md:hidden flex flex-col">
                                @php
                                    $waktu2 = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Minggu')->first();

                                    if(is_null($waktu2)){
                                        echo '-';
                                    }else{
                                        $waktuDiPisah = explode('-', $waktu2->jam);
                                        echo '<span class="leading-tight">' . $waktuDiPisah[0] . '-</span>
                                            <span class="leading-tight">' . $waktuDiPisah[1] . '</span>';
                                    }
                                @endphp
                            </div>      
                            <div class="hidden md:block">
                                @php
                                    $waktu = $jadwals->where('id_dokter', $item->id_dokter)->where('hari', 'Minggu')->first();

                                    if(is_null($waktu)){
                                        echo '-';
                                    }else{
                                        echo '<span class="leading-tight">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mt-1 md:mt-4 md:justify-end">
                        <p class="text-blue-900 font-bold leading-none mr-3">Buat janji temu</p>
                        <svg class="w-[16px] h-[16px] fill-blue-900 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="border-gray-300 rounded-2xl flex border-4 md:max-h-[150px]">
        <div class="w-1/4 flex">
            <img src="{{ asset('./assets/img/logo.png') }}" alt="dokter" class="m-auto md:h-full">
        </div>
        <div class="w-full p-2 md:pr-9">
            <div class="md:hidden">
                <div class="border-2 border-green-500 rounded-xl w-min flex items-center gap-2 px-2">
                    <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                </div>
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
            </div>
            <div class="hidden md:flex md:gap-6">
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
                <div class="border-2 border-green-500 rounded-xl w-min flex items-center gap-2 px-2">
                    <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                </div>
            </div>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Spesialis penyakit dalam</p>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Senin-Jumat: 10:00-22:00</p>
            <div class="flex items-center mt-1 md:justify-end">
                <p class="text-blue-900 font-bold leading-none mr-3">Buat janji temu</p>
                <svg class="w-[16px] h-[16px] fill-blue-900 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
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
                    <svg class="w-2 h-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-red-500 font-bold mb-1 text-nowrap">tidak ada</span>
                </div>
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
            </div>
            <div class="hidden md:flex md:gap-6">
                <p class="font-bold md:text-xl">Dr. Lorem Ipsum S.Ked.</p>
                <div class="border-2 border-red-500 rounded-xl w-min flex items-center gap-2 px-2 h-min">
                    <svg class="w-2 h-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                    <span class="leading-none text-red-500 font-bold mb-1 text-nowrap pt-1">tidak ada</span>
                </div>
            </div>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Spesialis penyakit dalam</p>
            <p class="text-gray-500 leading-tight md:text-lg md:leading-6">Senin-Jumat: 10:00-22:00</p>
            <div class="flex items-center mt-1 md:justify-end">
                <p class="text-blue-900 font-bold leading-none mr-3">Buat janji temu</p>
                <svg class="w-[16px] h-[16px] fill-blue-900 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
            </div>
        </div>
    </div>
</div>
@endsection