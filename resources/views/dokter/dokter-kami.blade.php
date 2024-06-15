@extends('layouts.main')

@section('container')
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Dokter Kami</h1>
    </div>
</div>
<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">
<div class="flex flex-col gap-4 p-5">
    <div class="bg-[#222C67] text-white p-4 max-[640px]:p-3 rounded-lg mb-2 flex items-center">
        <div class="flex-1">
            <p class="font-vold text-lg sm:text-md max-[640px]:text-sm">"Kami menyediakan dokter berpengalaman yang siap memberikan perawatan terbaik untuk setiap pasien kami. Kesehatan Anda adalah prioritas utama kami."</p>
        </div>
        <div>
            <img src="{{ asset('assets/img/picture-quotes.png') }}" alt="Doctor" class="w-24 h-25 max-[640px]:w-17 max-[640px]:h-17">
        </div>
    </div>
    @if($dokters->isEmpty())
        <div class="mt-4 text-center">
            <p class="text-xl font-bold">Dokter tidak ada</p>
        </div>
    @else
        @php
            // Fungsi untuk mendapatkan index hari berikutnya
            function getHariBerikutnya($hari, $urutanHari) {
                $index = array_search($hari, $urutanHari);
                return $urutanHari[($index + 1) % 7];
            }
        @endphp
        @foreach($dokters as $item)
            <div class="border-gray-300 rounded-2xl flex border-4 shadow-lg">
                <div class="w-1/4 flex pl-2">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="dokter" class="m-auto mt-2 md:m-auto md:max-h-44 rounded-lg">
                    @else
                        <svg class="m-auto mt-4 md:m-auto md:max-h-44" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    @endif
                </div>
                <div class="w-full p-2 md:pr-9">
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

                        // Array untuk urutan hari dalam seminggu dalam bahasa Indonesia
                        $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                        // Memeriksa jadwal untuk hari ini
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

                        // Jika tidak ada jadwal yang sesuai untuk hari ini, cari hari berikutnya
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
                                        break 2; // Keluar dari kedua loop
                                    }
                                }
                            }
                        }

                        /* echo "Status: " . ($status ? 'true' : 'false') . "\n";
                        echo "Rekomendasi Jam: " . $jamRekomendasi . "\n";
                        echo "Rekomendasi Tanggal: " . $tanggalRekomendasi . "\n";
                        
                        foreach ($waktus as $item2) {
                            if($hariSaatIni == $item2->hari){
                                $waktuDiPisahKeadaan = explode('-', $item2->jam);
                                $waktuSaatIniTimestamp = strtotime($waktuSaatIni);
                                $waktuMulai = strtotime($waktuDiPisahKeadaan[0]);
                                $waktuAkhir = strtotime($waktuDiPisahKeadaan[1]);

                                // kalau jam saat ini di antara
                                if ($waktuSaatIniTimestamp >= $waktuMulai && $waktuSaatIniTimestamp <= $waktuAkhir) {
                                    $status = true;
                                    $jamRekomendasi = $item2->jam;
                                }
                            }
                        } */

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
                    {{-- <div class="flex items-center mt-2 md:mt-4 md:justify-end">
                        <a href="/reservasi/buat?tanggal={{ $tanggalRekomendasi }}&spesialis={{ $item->spesialis }}&nama={{ $item->nama }}&waktu={{ $jamRekomendasi }}" class="text-blue-900 font-bold leading-none mr-3">Buat janji temu</a>
                        <svg class="w-[16px] h-[16px] fill-blue-900 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
                    </div> --}}
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection