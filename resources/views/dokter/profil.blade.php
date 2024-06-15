@extends('layouts.main')

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
<div id="success" class="mb-4 bg-green-300 py-3 px-4 text-white rounded-lg hidden"></div>
<div id="failed-ubah-profil" class="mb-4 bg-red-300 py-3 px-4 text-white rounded-lg hidden"></div>
<div class="flex flex-col gap-4">
    <p class="text-2xl md:text-3xl font-bold">Profil</p>
    <form method="POST" class="flex justify-center md:text-lg">
        @csrf
        @method('PUT')
        <div class="w-full md:max-w-4xl flex flex-col items-center gap-4">
            {{-- tidak ada foto --}}
            @if(auth()->user()->foto == null)
                <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                <div id="div-foto" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300 hidden">
                    <img id="tampilkan-foto" alt="foto-profil" class="object-cover object-top w-full h-full">
                </div>
                <div class="flex flex-col gap-2 items-center">
                    <div class="flex gap-2">
                        <span id="ubah-foto" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap">Ubah Foto</span>
                        <span id="simpan" onclick="simpan('{{ csrf_token() }}', 'tambah', '/dokter/profil')" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap hidden">Simpan</span>
                        <span id="batal" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap hidden">Batal</span>
                    </div>
                    <span id="error-message" class="text-red-500 hidden">Silakan pilih file gambar (jpg, jpeg, png).</span>
                </div>
            {{-- ada foto --}}
            @else
                <svg id="ikon-bawaan" class="w-2/5 h-2/5 md:w-52 md:h-52 hidden" xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#222c67" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                <div id="div-foto" class="w-1/3 h-1/3 md:w-40 md:h-40 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                    <img id="tampilkan-foto" src="{{ asset('storage/' . auth()->user()->foto) }}" alt="foto-profil" class="object-cover object-top w-full h-full">
                </div>
                <div class="flex flex-col gap-2 items-center">
                    <div class="flex gap-2">
                        <span id="ubah-foto" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap">Ubah Foto</span>
                        <span id="hapus-foto" onclick="klikTombolHapusFoto('/dokter/profil')" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap">Hapus Foto</span>
                        <span id="simpan" onclick="simpan('{{ csrf_token() }}', 'ubah', '/dokter/profil')" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap hidden">Simpan</span>
                        <span id="batal" class="border-2 rounded-lg border-[#8E8D8B] text-[#8E8D8B] font-semibold px-3 py-2 cursor-pointer w-min text-nowrap hidden">Batal</span>
                    </div>
                    <span id="error-message" class="text-red-500 hidden">Silakan pilih file gambar (jpg, jpeg, png).</span>
                </div>
            @endif
            <input id="foto" type="file" class="hidden">
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="rounded-lg" placeholder="Masukkan nama lengkap" value="{{ old('nama', auth()->user()->dokter->nama) }}" readonly>
                    @error('nama')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="nomor_handphone">Nomor Handphone</label>
                    <input type="number" pattern="^\d+$" name="nomor_handphone" id="nomor_handphone" class="rounded-lg" placeholder="Contoh: 081234567890" value="{{ old('nomor_handphone', auth()->user()->nomor_handphone) }}" readonly>
                    @error('nomor_handphone')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="rounded-lg" placeholder="Masukkan alamat" value="{{ old('alamat', auth()->user()->dokter->alamat) }}" readonly>
                    @error('alamat')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="alamat">Jenis Kelamin</label>
                    <div>
                        <input type="radio" name="jenis_kelamin" id="L" value="L" {{ old('jenis_kelamin', auth()->user()->dokter->jenis_kelamin) == 'L' ? 'checked' : '' }} disabled>
                        <label class="font-semibold mr-2" for="L">Laki-laki</label>
                        <input type="radio" name="jenis_kelamin" id="P" value="P" {{ old('jenis_kelamin', auth()->user()->dokter->jenis_kelamin) == 'P' ? 'checked' : '' }} disabled>
                        <label class="font-semibold" for="P">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="flex flex-col w-full">
                    <label class="font-semibold" for="nama">Spesialis</label>
                    <input type="text" name="spesialis" id="spesialis" class="rounded-lg" placeholder="Pilih spesialis" value="{{ old('spesialis', auth()->user()->dokter->spesialis) }}" readonly>
                    @error('spesialis')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col w-full"></div>
            </div>
            {{-- <button type="submit" class="border-2 rounded-lg border-[#222C67] text-[#222C67] dark:text-white dark:bg-[#222C67] font-semibold px-6 py-2 mt-4">Ubah</button>
            <span class="text-gray-500">Untuk mengubah data profil, silahkan ubah data yang ditampilkan lalu tekan tombol <b>ubah</b></span> --}}
        </div>
    </form>
    <hr class="my-3 h-[2px] bg-gray-300">
    <p class="text-2xl md:text-3xl font-bold mt-1">Ubah Kata Sandi</p>
    <p class="md:text-lg">Ubah kata sandi untuk mengamankan akun anda</p>
    <a href="{{ route('password.edit') }}" class="border-2 rounded-lg border-[#222C67] text-[#222C67] dark:text-white dark:bg-[#222C67] font-semibold px-6 py-2 w-min text-nowrap">Ubah Kata Sandi</a>
</div>
@push('scripts')
    <script>
        let csrf = '{{ csrf_token() }}'
    </script>
    <script src="{{ asset('assets/js/profil.js') }}"></script>
@endpush
@endsection