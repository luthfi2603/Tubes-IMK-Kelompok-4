@extends('layouts.main')

@section('container')

@if(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] text-[#0f5132] border-2 border-[#badbcc] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-regular fa-circle-check mr-1"></i>
        <span>{{ session('success') }}</span>
    </div>
@elseif(session()->has('failed'))
    <div id="failed-php" class="bg-[#f8d7da] text-[#842029] border-2 border-[#f5c2c7] px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        <i class="fa-solid fa-circle-exclamation mr-1"></i>
        <span>{{ session('failed') }}</span>
    </div>
@endif

<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-[#222C67] mb-4 md:mb-0">Reservasi</h1>
        <a href="{{ route('buat.reservasi') }}">
            <button class="bg-[#222C67] hover:bg-[#6c7cda] text-white px-4 py-2 rounded-full shadow-md transition duration-300">+ Buat Reservasi</button>
        </a>
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-6">

    <div class="flex flex-wrap justify-center md:justify-end gap-2 mb-6">
        <button class="filter-btn bg-blue-200 hover:bg-[#b2c8df] hover:text-blue-800 text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="all"><i class="fa-solid fa-list-check mr-2"></i>Semua</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#b2c8df] hover:text-blue-800 text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Menunggu"><i class="fa-solid fa-stopwatch mr-2"></i>Menunggu</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#b2c8df] hover:text-blue-800 text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Selesai"><i class="fa-solid fa-check mr-2"></i>Selesai</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#b2c8df] hover:text-blue-800 text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Batal"><i class="fa-solid fa-xmark mr-2"></i>Batal</button>        
    </div>

    <div id="appointment-list" class="space-y-4">
        @if($reservasis->isEmpty())
            <div class="flex justify-center items-center mt-12">
                <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-full md:w-3/4 flex flex-col md:flex-row items-center justify-center md:space-y-0 md:space-x-4">
                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                    <p class="text-xl text-[#222C67]">Anda Belum Pernah Reservasi</p>
                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="hidden md:block w-16 h-16">
                </div>
            </div>
        @else
            @foreach($reservasis as $reservasi)
                <div class="appointment-card bg-white rounded-lg shadow-md p-4 py-6 flex flex-col md:flex-row items-center justify-between" data-status="{{ $reservasi->status }}" data-date="{{ $reservasi->tanggal }}">
                    <div class="flex items-center space-x-4">
                        @php
                            $foto = null;
                            foreach ($docterPhotos as $key) {
                                if($key['nama_dokter'] == $reservasi->nama_dokter){
                                    $foto = $key['foto'];
                                    break;
                                }
                            }
                        @endphp
                        @if($foto)
                            <div class="w-16 h-16 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                <img src="{{ asset('storage/' . $foto) }}" alt="perawat" class="object-cover object-top w-full h-full">
                            </div>
                        @else
                            <div class="w-16 h-16">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <h2 class="text-xl font-semibold text-[#222C67]">{{ $reservasi->nama_dokter }}</h2>
                            <p class="text-md py-0.5 text-gray-600">{{ $reservasi->spesialis }}</p>
                            <p class="text-md py-0.5 text-gray-600">Dibuat pada : {{ \Carbon\Carbon::parse($reservasi->created_at)->translatedFormat('l, d F Y, H:i') }}</p>
                            <p class="text-md py-0.5 text-blue-500">Waktu kunjungan : {{ \Carbon\Carbon::parse($reservasi->tanggal)->translatedFormat('l, d F Y') }}</p>
                            @if($reservasi->waktu_rekomendasi)
                                <p class="text-md py-0.5 text-blue-500">Pada pukul : {{ $reservasi->waktu_rekomendasi }}</p>
                            @endif
                            @if($reservasi->status == 'Menunggu')
                                <div class="flex gap-2 mt-2">
                                    <form method="POST" action="{{ route('destroy.reservasi') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $reservasi->id }}">
                                        <button class="bg-[#b02126] hover:bg-red-500 rounded-lg py-1.5 px-3 text-white w-min">Batalkan</button>
                                    </form>
                                    <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="bg-yellow-500 hover:bg-yellow-400 rounded-lg py-1.5 px-3 text-white w-min text-nowrap">Ubah</a>
                                </div>
                            @elseif($reservasi->status == 'Selesai')
                                @if($reservasi->id_rekam_medis)
                                    <a href="{{ route('rekam.medis.detail', $reservasi->id_rekam_medis) }}" class="bg-blue-500 hover:bg-blue-400 rounded-lg py-1 px-3 text-white w-min mt-2 text-nowrap">Rekam Medis</a>
                                @else
                                    <span class="bg-blue-300 rounded-lg py-1 px-3 text-white w-min text-nowrap mt-2">Rekam Medis Belum Ada</span>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if($reservasi->status == 'Menunggu')
                        <span class="bg-blue-100 text-blue-800 text-md font-medium px-4 py-2 rounded-full mt-2 md:mt-0">{{ $reservasi->status }}</span>
                    @elseif($reservasi->status == 'Selesai')
                        <span class="bg-green-100 text-green-800 text-md font-medium px-4 py-2 rounded-full mt-2 md:mt-0">{{ $reservasi->status }}</span>
                    @else
                        <span class="bg-red-100 text-red-800 text-md font-medium px-4 py-2 rounded-full mt-2 md:mt-0">{{ $reservasi->status }}</span>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const appointmentCards = document.querySelectorAll('.appointment-card');
        const appointmentList = document.getElementById('appointment-list');

        const statusText = {
            all: 'Semua',
            Menunggu: 'Menunggu',
            Selesai: 'Selesai',
            Batal: 'Batal'
        };

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                
                let hasAppointment = false;
                appointmentCards.forEach(card => {
                    if (status === 'all' || card.getAttribute('data-status') === status) {
                        card.style.display = 'flex';
                        hasAppointment = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (!hasAppointment) {
                    const statusMessage = statusText[status] || status;
                    appointmentList.innerHTML = `
                        <div class="flex justify-center items-center mt-12">
                            <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-full md:w-3/4 flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
                                <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                                <p class="text-xl text-[#222C67]">Tidak Ada Reservasi Yang ${statusMessage}</p>
                                <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                            </div>
                        </div>
                    `;
                } else {
                    appointmentList.innerHTML = '';
                    appointmentCards.forEach(card => {
                        if (status === 'all' || card.getAttribute('data-status') === status) {
                            appointmentList.appendChild(card);
                        }
                    });
                }

                filterButtons.forEach(btn => btn.classList.remove('bg-blue-200', 'text-blue-800'));
                this.classList.add('bg-blue-200', 'text-blue-800', 'font-semibold');
            });
        });

    });
</script>

@endsection
