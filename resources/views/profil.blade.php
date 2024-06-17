@extends('layouts.main')

@section('container')
@if(session()->has('failed'))
    <div id="failed" class="bg-[#f8d7da] dark:bg-red-800 text-[#842029] dark:text-red-200 border-2 border-[#f5c2c7] dark:border-red-700 px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div id="success-php" class="bg-[#d1e7dd] dark:bg-green-800 text-[#0f5132] dark:text-green-200 border-2 border-[#badbcc] dark:border-green-700 px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999]">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto p-4">

    <div id="success" class="bg-[#d1e7dd] dark:bg-green-800 text-[#0f5132] dark:text-green-200 border-2 border-[#badbcc] dark:border-green-700 px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999] hidden"></div>
    <div id="failed-ubah-profil" class="bg-[#f8d7da] dark:bg-red-800 text-[#842029] dark:text-red-200 border-2 border-[#f5c2c7] dark:border-red-700 px-4 py-3 rounded-lg fixed inset-x-[296px] z-[999] hidden"></div>
    
    <div class="flex flex-col gap-4">
        <p class="text-2xl md:text-3xl font-bold text-[#222C67] dark:text-white">Profil</p>

        <hr class="border-1 border-[#B1B0AF] dark:border-gray-700 mb-8">

        <form method="POST" action="{{ route('pasien.profil') }}" class="flex justify-center md:text-lg">
            @csrf
            @method('PUT')
            <div class="w-full md:max-w-4xl flex flex-col items-center gap-5">
                {{-- tidak ada foto --}}
                @if(auth()->user()->foto == null)
                    <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    <div id="div-foto" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 hidden">
                        <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                    <div class="flex flex-col gap-2 items-center">
                        <div class="flex gap-2">
                            <button id="ubah-foto" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"><i class="fa-solid fa-pen-to-square mr-2"></i>Ubah Foto</button>
                            <span id="simpan" onclick="simpan('{{ csrf_token() }}', 'tambah', '/profil')" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 hidden dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan</span>
                            <button id="batal" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 hidden dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"><i class="fa-solid fa-xmark mr-2"></i>Batal</button>
                        </div>
                        <span id="error-message" class="text-red-500 hidden">Silakan pilih file gambar (jpg, jpeg, png).</span>
                    </div>
                {{-- ada foto --}}
                @else
                    <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52 hidden" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                    <div id="div-foto" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 dark:border-gray-600">
                        <img id="tampilkan-foto" src="{{ asset('storage/' . auth()->user()->foto) }}" alt="foto-profil" class="object-cover object-top w-full h-full">
                    </div>
                    <div class="flex flex-col gap-2 items-center">
                        <div class="flex gap-2">
                            <button id="ubah-foto" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"><i class="fa-solid fa-pen-to-square mr-2"></i>Ubah Foto</button>
                            <button id="hapus-foto" onclick="klikTombolHapusFoto('/profil')" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"><i class="fa-solid fa-trash mr-2"></i>Hapus Foto</button>
                            <span id="simpan" onclick="simpan('{{ csrf_token() }}', 'ubah', '/profil')" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 hidden dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800"><i class="fa-solid fa-floppy-disk mr-2"></i>Simpan</span>
                            <button id="batal" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 hidden dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800"><i class="fa-solid fa-xmark mr-2"></i>Batal</button>
                        </div>
                        
                        <span id="error-message" class="text-red-500 hidden">Silakan pilih file gambar (jpg, jpeg, png).</span>
                    </div>
                @endif
                <input id="foto" type="file" class="hidden">
                <div class="w-full flex flex-col md:flex-row gap-4">
                    <div class="flex flex-col w-full">
                        <label class="font-semibold dark:text-gray-300" for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400" placeholder="Masukkan nama lengkap" value="{{ old('nama', auth()->user()->pasien->nama) }}">
                        @error('nama')
                            <div class="text-[#B42223] text-bold text-md py-1 px-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="font-semibold dark:text-gray-300" for="nomor_handphone">Nomor Handphone</label>
                        <input type="number" pattern="^\d+$" name="nomor_handphone" id="nomor_handphone" class="rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400" placeholder="Contoh: 081234567890" value="{{ old('nomor_handphone', auth()->user()->nomor_handphone) }}">
                        @error('nomor_handphone')
                            <div class="text-[#B42223] text-bold text-md py-1 px-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row gap-4">
                    <div class="flex flex-col w-full">
                        <label class="font-semibold dark:text-gray-300" for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400" placeholder="Masukkan alamat" value="{{ old('alamat', auth()->user()->pasien->alamat) }}">
                        @error('alamat')
                            <div class="text-[#B42223] text-bold text-md py-1 px-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="font-semibold dark:text-gray-300 mb-1" for="alamat">Jenis Kelamin</label>
                        @if(auth()->user()->pasien->jenis_kelamin == 'P')
                            <div>
                                <input type="radio" id="L" value="L" disabled>
                                <label class="font-semibold mr-2 dark:text-gray-300" for="L">Laki-laki</label>
                                <input type="radio" id="P" value="P" checked disabled>
                                <label class="font-semibold dark:text-gray-300" for="P">Perempuan</label>
                            </div>
                        @elseif(auth()->user()->pasien->jenis_kelamin == 'L')
                            <div>
                                <input type="radio" id="L" value="L" checked disabled>
                                <label class="font-semibold mr-2 dark:text-gray-300" for="L">Laki-laki</label>
                                <input type="radio" id="P" value="P" disabled>
                                <label class="font-semibold dark:text-gray-300" for="P">Perempuan</label>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row gap-4">
                    <div class="flex flex-col w-full">
                        <label class="font-semibold dark:text-gray-300" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" class="rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggal_lahir', auth()->user()->pasien->tanggal_lahir) }}" disabled>
                        @error('tanggal_lahir')
                            <div class="text-[#B42223] text-bold text-md py-1 px-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="font-semibold dark:text-gray-300" for="pekerjaan">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="rounded-lg dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400" placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan', auth()->user()->pasien->pekerjaan) }}">
                        @error('pekerjaan')
                            <div class="text-[#B42223] text-bold text-md py-1 px-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-md text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 px-6 py-2 mt-4"><i class="fa-solid fa-pen-to-square mr-2"></i>Ubah</button>
                <span class="text-gray-500 dark:text-gray-300">Untuk mengubah data profil, silahkan ubah data yang ditampilkan lalu tekan tombol <b>ubah</b></span>
            </div>
        </form>
        <hr class="my-3 h-[2px] bg-gray-300 dark:bg-gray-700">
        <p class="text-2xl md:text-3xl font-bold mt-1 dark:text-white">Ubah Kata Sandi</p>
        <p class="md:text-md dark:text-gray-300">Ubah kata sandi untuk mengamankan akun anda</p>
        <a href="{{ route('password.edit') }}">
            <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-md px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"><i class="fa-solid fa-pen-to-square mr-2"></i>Ubah Kata Sandi</button>
        </a>
        <hr class="my-3 h-[2px] bg-gray-300 dark:bg-gray-700">
        <p class="text-[#B42223] text-2xl md:text-3xl font-bold mt-1 dark:text-red-400">Hapus Akun</p>
        <p class="text-justify md:text-md dark:text-gray-300">Setelah akun Anda dihapus, maka anda tidak dapat lagi mengakses informasi dan fitur dalam website klinik RH61 ini, silahkan daftarkan diri anda lagi jika ingin melihat kembali informasi dan mengakses kembali website ini.</p>
        <form method="POST" action="{{ route('akun.destroy') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="border-2 rounded-lg bg-gray-200 dark:bg-gray-700 dark:text-red-300 border-gray-300 dark:border-gray-600 text-[#B42223] hover:text-white hover:bg-[#B42223] hover:border-[#B42223] font-semibold px-6 py-2 w-min text-nowrap"><i class="fa-solid fa-trash mr-2"></i>Hapus akun anda</button>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        let csrf = '{{ csrf_token() }}'
    </script>
    <script src="{{ asset('assets/js/profil.js') }}"></script>
@endpush
@endsection
