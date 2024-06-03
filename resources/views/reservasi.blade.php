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
        <h1 class="text-3xl font-bold text-[#222C67]">Appointment</h1>
        <a href="{{ route('buat.reservasi') }}">
            <button class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] px-4 py-2 rounded-full shadow-md transition duration-300">+ Buat Reservasi</button>
        </a>
    </div>

    <hr class="border-1 border-[#B1B0AF] mb-6 ml-4">

    <div class="flex justify-end space-x-2 mb-6">
        <button class="filter-btn bg-blue-200 hover:bg-[#b2c8df] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="all">Semua</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#E3EBF3] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Menunggu">Menunggu</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#E3EBF3] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Selesai">Selesai</button>
        <button class="filter-btn bg-blue-200 hover:bg-[#E3EBF3] text-gray-700 px-3 py-2 rounded-md shadow-sm font-semibold transition duration-300" data-status="Dibatalkan">Dibatalkan</button>        
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
                    <img src="https://via.placeholder.com/50" alt="Doctor Image" class="w-16 h-16 rounded-full">
                    <div>
                        <h2 class="text-xl font-semibold text-[#222C67]">{{ $reservasi->nama_dokter }}</h2>
                        <p class="text-md py-0.5 text-gray-600">{{ $reservasi->spesialis }}</p>
                        <p class="text-md py-0.5 text-gray-600">{{ $reservasi->tanggal }}</p>
                        <p class="text-md py-0.5 text-gray-600">{{ $reservasi->jam }}</p>
                    </div>
                </div>
                @if($reservasi->status == 'Menunggu')
                    <span class="bg-blue-100 text-blue-800 text-md font-medium px-4 py-2 rounded-full">{{ $reservasi->status }}</span>
                @elseif($reservasi->status == 'Selesai')
                    <span class="bg-green-100 text-green-800 text-md font-medium px-4 py-2 rounded-full">{{ $reservasi->status }}</span>
                @elseif($reservasi->status == 'Dibatalkan')
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
            Dibatalkan: 'Dibatalkan'
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