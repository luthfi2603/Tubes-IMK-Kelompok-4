@extends('layouts.main')

@section('container')

@if(session()->has('failed'))
    <div id="failed-php" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6 ml-4">
        <h1 class="text-3xl font-bold text-[#222C67]">Reservasi</h1>
        <a href="{{ route('buat.reservasi') }}">
            <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] px-4 py-2 rounded-full shadow-md transition duration-300">+ Buat Reservasi</button>
        </a>
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-6 ml-4">

    <div class="flex justify-end space-x-2 mb-6">
        <button class="filter-btn bg-blue-200 hover:bg-[#b2c8df] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="all">Semua</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#E3EBF3] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Menunggu">Menunggu</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#E3EBF3] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Selesai">Selesai</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#E3EBF3] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Batal">Batal</button>        
    </div>

    <div id="appointment-list" class="space-y-4">
        @if($reservasis->isEmpty())
            <div class="flex justify-center items-center mt-12">
                <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-3/4 flex items-center justify-center space-x-4">
                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                    <p class="text-xl text-[#222C67]">Anda Belum Pernah Reservasi</p>
                    <img src="{{ asset('assets/img/nurse-2.png') }}" alt="No Appointments" class="w-16 h-16">
                </div>
            </div>
        @else
            @foreach($reservasis as $reservasi)
                <div class="appointment-card bg-white rounded-lg shadow-md p-4 flex items-center justify-between" data-status="{{ $reservasi->status }}" data-date="{{ $reservasi->tanggal }}">
                    <div class="flex items-center space-x-4">
                        @php
                            foreach ($docterPhotos as $key) {
                                if($key['nama_dokter'] == $reservasi->nama_dokter){
                                    $foto = $key['foto'];
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
                                    <form onsubmit="batalkanReservasi(event)" method="POST" action="{{ route('destroy.reservasi') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $reservasi->id }}">
                                        <button class="bg-[#b02126] rounded-lg py-1 px-3 text-white w-min">Batalkan</button>
                                    </form>
                                    <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="bg-yellow-500 rounded-lg py-1 px-3 text-white w-min text-nowrap">Ubah</a>
                                </div>
                            @elseif($reservasi->status == 'Selesai')
                                @if($reservasi->id_rekam_medis)
                                    <a href="{{ route('rekam.medis.detail', $reservasi->id_rekam_medis) }}" class="bg-blue-500 rounded-lg py-1 px-3 text-white w-min mt-2 text-nowrap">Rekam Medis</a>
                                @else
                                    <span class="bg-blue-300 rounded-lg py-1 px-3 text-white w-min text-nowrap mt-2">Rekam Medis Belum Ada</span>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if($reservasi->status == 'Menunggu')
                        <span class="bg-blue-100 text-blue-800 text-md font-medium px-4 py-2 rounded-full">{{ $reservasi->status }}</span>
                    @elseif($reservasi->status == 'Selesai')
                        <span class="bg-green-100 text-green-800 text-md font-medium px-4 py-2 rounded-full">{{ $reservasi->status }}</span>
                    @else
                        <span class="bg-red-100 text-red-800 text-md font-medium px-4 py-2 rounded-full">{{ $reservasi->status }}</span>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const sortButtons = document.querySelectorAll('.sort-btn');
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
                            <div class="bg-[#E3EBF3] text-center p-4 rounded-lg shadow-md font-bold w-3/4 flex items-center justify-center space-x-4">
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