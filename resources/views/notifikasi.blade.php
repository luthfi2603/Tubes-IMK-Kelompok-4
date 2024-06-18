@extends('layouts.main')

@section('container')

<div class="container mx-auto p-4 mb-44">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-[#222c67] dark:text-white">Notifikasi Pasien</h1>
    </div>
    <hr class="border-1 border-[rgb(177,176,175)] dark:border-gray-600 mb-8">
    <div class="space-y-4">
        @if($notifikasi->isEmpty())
            <div class="flex justify-center items-center mt-12">
                <div class="bg-[#E3EBF3] dark:bg-gray-800 text-center p-4 rounded-lg shadow-md font-bold w-full md:w-3/4 flex flex-col md:flex-row items-center justify-center md:space-y-0 md:space-x-4">
                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                    <p class="text-xl text-[#222C67] dark:text-white">Belum ada Notifikasi</p>
                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="hidden md:block w-16 h-16">
                </div>
            </div>
        @else
            @foreach($notifikasi as $item)
                @switch($item->status)
                    @case('Menunggu')
                        <div class="bg-white dark:bg-gray-900 border-l-4 border-yellow-600 rounded-lg shadow-md p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="text-yellow-600 text-2xl">•</span>
                                <div>
                                    <p class="text-lg text-gray-700 dark:text-gray-300">
                                        Janji temu anda dengan <span class="font-bold text-[#222C67] dark:text-white">Dr. {{ $item->nama_dokter }}</span> pada 
                                        <span class="font-bold text-[#222C67] dark:text-white">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }} jam {{ $item->waktu_rekomendasi }} </span> telah
                                        <span class="font-semibold text-yellow-600">berhasil dibuat</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @break
                    @case('Selesai')
                        <div class="bg-white dark:bg-gray-900 border-l-4 border-green-600 rounded-lg shadow-md p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="text-green-600 text-2xl">•</span>
                                <div>
                                    <p class="text-lg text-gray-700 dark:text-gray-300">
                                        Janji temu anda dengan <span class="font-bold text-[#222C67] dark:text-white">Dr. {{ $item->nama_dokter }}</span> pada 
                                        <span class="font-bold text-[#222C67] dark:text-white">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }} jam {{ $item->waktu_rekomendasi }} </span>
                                        telah <span class="font-semibold text-green-600">selesai dilakukan</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @break
                    @case('Batal')
                        <div class="bg-white dark:bg-gray-900 border-l-4 border-red-600 rounded-lg shadow-md p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="text-red-600 text-2xl">•</span>
                                <div>
                                    <p class="text-lg text-gray-700 dark:text-gray-300">
                                        Kamu <span class="font-semibold text-red-600">berhasil membatalkan </span> janji temu anda dengan <span class="font-bold text-[#222C67] dark:text-white">Dr. {{ $item->nama_dokter }}</span> pada 
                                        <span class="font-bold text-[#222C67] dark:text-white">{{ \Carbon\Carbon::parse($item->updated_at)->translatedFormat('l, d F Y \j\a\m H:i') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @break
                    @default
                        @php abort(404) @endphp
                @endswitch
            @endforeach
        @endif
    </div>
</div>
@endsection