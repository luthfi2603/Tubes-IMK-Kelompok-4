@extends('dokter.main')

@section('container')

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
            <label for="tanggal" class="block text-gray-700 text-md font-bold mb-2">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="nama_pasien" class="block text-gray-700 text-md font-bold mb-2">Nama Pasien:</label>
            <input type="text" name="nama_pasien" id="nama_pasien" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan nama pasien" required>
        </div>

        <div class="mb-4">
            <label for="penyakit" class="block text-gray-700 text-md font-bold mb-2">Penyakit:</label>
            <input type="text" name="penyakit" id="penyakit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan penyakit pasien" required>
        </div>

        <div class="mb-4">
            <label for="dokter" class="block text-gray-700 text-md font-bold mb-2">Dokter:</label>
            <input type="text" name="dokter" id="dokter" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan nama dokter" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 text-md font-bold mb-2">Statuass:</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="Selesai">Selesai</option>
                <option value="Proses">Proses</option>
                <option value="Ditunda">Ditunda</option>
            </select>
        </div>

        <div class="flex items-center justify-between mt-6 mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
            <div>
                <a href="" class="inline-block align-baseline font-bold text-md text-red-500 hover:text-red-700 mr-4">
                    Reset
                </a>
                <a href="{{ route('dokter.rekam.medis') }}" class="inline-block align-baseline font-bold text-md text-yellow-500 hover:text-yellow-800">
                    Kembali
                </a>
            </div>
        </div>
    </form>
</div>

@endsection
