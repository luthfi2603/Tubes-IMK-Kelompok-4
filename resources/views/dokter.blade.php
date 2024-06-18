@extends('layouts.main')

@section('container')
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white mb-4 md:mb-0">Dokter Kami</h1>
    </div>

    <hr class="border-1 border-[#B1B0AF] dark:border-gray-700 mb-4">

    <div class="bg-[#7f89c0] dark:bg-slate-600 text-white p-4 max-[640px]:p-3 rounded-lg flex items-center mb-6">
        <div class="flex-1">
            <p class="font-vold text-lg sm:text-md max-[640px]:text-sm">"Kami menyediakan dokter berpengalaman yang siap memberikan perawatan terbaik untuk setiap pasien kami. Kesehatan Anda adalah prioritas utama kami."</p>
        </div>
        <div>
            <img src="{{ asset('assets/img/dokter-3.png') }}" alt="Doctor" class="w-25 h-24 max-[640px]:w-17 max-[640px]:h-17">
        </div>
    </div>
    
    @if($dokters->isEmpty())
    <div class="bg-[#E3EBF3] dark:bg-gray-900 text-center p-4 rounded-lg shadow-md font-bold w-full md:w-3/4 flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
            <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
            <p class="text-xl text-[#222C67] dark:text-gray-300">Belum ada Dokter yang Terdaftar</p>
            <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="hidden md:block w-16 h-16">
        </div>
    @else
        @php
            function getHariBerikutnya($hari, $urutanHari) {
                $index = array_search($hari, $urutanHari);
                return $urutanHari[($index + 1) % 7];
            }
        @endphp
        @foreach($dokters as $item)
            <div class="border-gray-300 dark:border-gray-700 rounded-2xl flex border-4 shadow-lg py-3 my-5 dark:bg-slate-800">
                <div class="w-1/4 flex pl-2">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="dokter" class="m-auto mt-2 md:m-auto md:max-h-44 rounded-lg">
                    @else
                        <svg class="m-auto mt-4 md:m-auto md:max-h-44" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    @endif
                </div>
                <div class="w-full p-2 md:pr-9 dark:text-white">
                    @php
                        $status = false;
                        $status2 = false;

                        $waktus = $jadwals->where('id_dokter', $item->id_dokter);
                        $waktuSaatIni = date('H:i');
                        $tanggalSaatIni = date('Y-m-d');
                        $tanggalRekomendasi = $tanggalSaatIni;
                        $jamRekomendasi = '00:00-00:00';

                        $hariInggris = date('l');
                        $hariHari = [
                            'Monday'    => 'Senin',
                            'Tuesday'   => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday'  => 'Kamis',
                            'Friday'    => 'Jumat',
                            'Saturday'  => 'Sabtu',
                            'Sunday'    => 'Minggu'
                        ];
                        $hariSaatIni = $hariHari[$hariInggris];

                        $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                        foreach ($waktus as $item2) {
                            if ($hariSaatIni == $item2->hari) {
                                $waktuDiPisahKeadaan = explode('-', $item2->jam);
                                $waktuSaatIniTimestamp = strtotime($waktuSaatIni);
                                $waktuMulai = strtotime($waktuDiPisahKeadaan[0]);
                                $waktuAkhir = strtotime($waktuDiPisahKeadaan[1]);

                                if ($waktuSaatIniTimestamp >= $waktuMulai && $waktuSaatIniTimestamp <= $waktuAkhir) {
                                    $status = true;
                                    $status2 = true;
                                    $jamRekomendasi = $item2->jam;
                                    break;
                                }
                            }
                        }

                        if (!$status2) {
                            $hariCari = $hariSaatIni;
                            $selisihHari = 0;
                            for ($i = 0; $i < 7; $i++) {
                                $hariCari = getHariBerikutnya($hariCari, $urutanHari);
                                $selisihHari++;
                                foreach ($waktus as $item2) {
                                    if ($hariCari == $item2->hari) {
                                        $jamRekomendasi = $item2->jam;
                                        $tanggalRekomendasi = date('Y-m-d', strtotime("+$selisihHari days", strtotime($tanggalSaatIni)));
                                        break 2;
                                    }
                                }
                            }
                        }

                        if($status){
                            echo '<div class="md:hidden">
                                    <div class="border-2 border-green-500 rounded-lg w-min flex items-center gap-2 px-2">
                                        <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                        <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                                    </div>
                                    <p class="font-bold md:text-xl">' . $item->nama . '</p>
                                </div>
                                <div class="hidden md:flex md:gap-6">
                                    <p class="font-bold md:text-xl">' . $item->nama . '</p>
                                    <div class="border-2 border-green-500 rounded-lg w-min flex items-center gap-2 px-2">
                                        <svg class="w-2 h-2 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                        <span class="leading-none text-green-500 font-bold mb-1">ada</span>
                                    </div>
                                </div>';
                        }else{
                            echo '<div class="md:hidden">
                                    <div class="border-2 border-red-500 rounded-lg w-min flex items-center gap-2 px-2">
                                        <svg class="w-2 h-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                        <span class="leading-none text-red-500 font-bold mb-1 text-nowrap pt-1">tidak ada</span>
                                    </div>
                                    <p class="font-bold md:text-xl">' . $item->nama . '</p>
                                </div>
                                <div class="hidden md:flex md:gap-6">
                                    <p class="font-bold md:text-xl">' . $item->nama . '</p>
                                    <div class="border-2 border-red-500 rounded-lg w-min flex items-center gap-2 px-2 h-min">
                                        <svg class="w-2 h-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
                                        <span class="leading-none text-red-500 font-bold mb-1 text-nowrap pt-1">tidak ada</span>
                                    </div>
                                </div>';
                        }
                    @endphp
                    <p class="text-gray-500 leading-tight dark:text-gray-300 md:text-lg md:leading-6">{{ $item->spesialis }}</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Senin</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Selasa</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Rabu</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Kamis</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Jumat</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Sabtu</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                        <div class="flex flex-col items-center p-1 border-2 rounded-lg dark:border-gray-600">
                            <span class="leading-tight dark:text-gray-300">Minggu</span>
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
                                        echo '<span class="leading-tight dark:text-gray-300">' . $waktu->jam . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center mt-2 md:mt-4 md:justify-end">
                        <a href="/reservasi/buat?tanggal={{ $tanggalRekomendasi }}&spesialis={{ $item->spesialis }}&nama={{ $item->nama }}&waktu={{ $jamRekomendasi }}" class="text-blue-900 dark:text-blue-300 font-bold leading-none mr-3 hover:text-green-600">Buat janji temu <span><i class="ml-1 fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
