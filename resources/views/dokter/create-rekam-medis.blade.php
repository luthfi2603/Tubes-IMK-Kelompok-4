@extends('dokter.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed" class="mb-4 bg-red-300 py-3 text-white px-4 rounded-lg">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="mb-4 bg-green-300 py-3 text-white px-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Tambah Rekam Medis Pasien</h1>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] mb-5 mx-4">

<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
    <form action="" method="POST">
        @csrf
                
        <div class="mb-4">
            <label for="keluhan" class="block text-gray-700 text-md font-bold mb-2">Keluhan:</label>
            <textarea class="w-full" name="keluhan" id="keluhan" placeholder="masukkan keluhan.."></textarea>
        
        <div class="mb-4">
            <label for="diagnosa" class="block text-gray-700 text-md font-bold mb-2">Diagnosa:</label>
            <textarea class="w-full" name="diagnosa" id="diagnosa" placeholder="masukkan diagnosa.."></textarea>
        </div>

        <div class="mb-4">
            <label for="therapie" class="block text-gray-700 text-md font-bold mb-2">Therapie:</label>
            <textarea class="w-full" name="therapie" id="therapie" placeholder="masukkan therapie.."></textarea>
        </div>
        <div class="flex items-center justify-between mt-6 mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
            <div>
                <a href="" class="inline-block align-baseline font-bold text-md text-red-500 hover:text-red-700 mr-4">
                    Reset
                </a>
                <a href="{{ route('dokter.janji-temu-dokter') }}" class="inline-block align-baseline font-bold text-md text-yellow-500 hover:text-yellow-800">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</div>

@endsection
