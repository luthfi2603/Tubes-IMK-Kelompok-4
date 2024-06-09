@extends('layouts.main')

@section('container')

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Tentang Kami</h1>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">

<div class="container mx-auto p-4">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-[#313b75] to-teal-600 rounded-lg shadow-lg p-6 mb-6"> 
        <div class="flex flex-col lg:flex-row items-center">
            <!-- Text Content -->
            <div class="lg:w-1/2 p-4 text-[#E3EBF3]">
                <h1 class="text-4xl font-bold mb-4">Solusi Kesehatan Anda</h1>
                <p class="text-lg mb-4">Kami menyediakan layanan kesehatan terbaik untuk memenuhi kebutuhan Anda. Dari pemeriksaan rutin hingga konsultasi spesialis, kami siap membantu Anda.</p>
                <div class="flex space-x-4">
                    <a href="{{ route('buat.reservasi') }}" class="bg-[#E8C51C] hover:bg-[#d3da78] text-[#130D19] px-4 py-3 my-3 rounded-full shadow-md transition duration-300 font-semibold">Klik di sini untuk reservasi</a>
                </div>
            </div>
            <!-- Image Content -->
            <div class="lg:w-1/2 p-4">
                <img src="{{ asset('assets/img/tentang-kami.png') }}" alt="Healthcare Illustration" class="w-full h-auto rounded-lg">
            </div>
        </div>
    
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-[#E3EBF3] rounded-lg p-4 text-center shadow-md transition duration-300 transform hover:scale-105">
                <img src="https://via.placeholder.com/50" alt="Icon" class="mx-auto mb-2">
                <h3 class="text-xl font-bold text-[#222C67]">Pemeriksaan Rutin</h3>
                <p class="text-[#130D19]">Layanan pemeriksaan kesehatan secara berkala.</p>
            </div>
            <div class="bg-[#E3EBF3] rounded-lg p-4 text-center shadow-md transition duration-300 transform hover:scale-105">
                <img src="https://via.placeholder.com/50" alt="Icon" class="mx-auto mb-2">
                <h3 class="text-xl font-bold text-[#222C67]">Konsultasi Spesialis</h3>
                <p class="text-[#130D19]">Konsultasi dengan dokter spesialis terbaik.</p>
            </div>
            <div class="bg-[#E3EBF3] rounded-lg p-4 text-center shadow-md transition duration-300 transform hover:scale-105">
                <img src="https://via.placeholder.com/50" alt="Icon" class="mx-auto mb-2">
                <h3 class="text-xl font-bold text-[#222C67]">Layanan Darurat</h3>
                <p class="text-[#130D19]">Siap membantu Anda dalam kondisi darurat.</p>
            </div>
            <div class="bg-[#E3EBF3] rounded-lg p-4 text-center shadow-md transition duration-300 transform hover:scale-105">
                <img src="https://via.placeholder.com/50" alt="Icon" class="mx-auto mb-2">
                <h3 class="text-xl font-bold text-[#222C67]">Perawatan Intensif</h3>
                <p class="text-[#130D19]">Fasilitas perawatan intensif yang modern.</p>
            </div>
        </div>
    </div>

    <!-- Map and Clinic Location -->
    <div id="peta-lokasi" class="bg-gradient-to-r from-teal-600 to-teal-500 rounded-lg shadow-lg p-6 mb-6 scroll-mt-[88px]">
        <h2 class="text-xl font-bold mb-4 text-[#E3EBF3]">Peta dan Lokasi Klinik</h2>
        <div class="relative aspect-w-16 aspect-h-9 mb-4 overflow-hidden rounded-lg shadow-lg border border-gray-300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.0999462463024!2d98.62378907396273!3d3.5644622504613963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312fa358f8ba73%3A0x763bbd6809da349d!2sRH61%20Clinic!5e0!3m2!1sen!2sus!4v1717130754766!5m2!1sen!2sus" 
            class="w-full" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <p class="text-lg text-[#E3EBF3]">Alamat Klinik: Jalan Ringroad, Asam Kumbang, Medan Selayang, Medan City, North Sumatra 20122, Indonesia</p>
    </div>
    
    <!-- Emergency Contacts -->
    <div id="kontak-darurat" class="bg-gradient-to-r from-[#313b75] to-[#3e4a92] rounded-lg shadow-lg p-6 mb-6 scroll-mt-[88px]">
        <h2 class="text-xl font-bold mb-4 text-[#E3EBF3]">Kontak Darurat</h2>
        <div class="space-y-4">
            <div class="p-3 bg-white rounded transition duration-300 transform hover:scale-100 hover:bg-[#E3EBF3] hover:text-[#130D19]">
                <h3 class="text-lg font-semibold">Nomor Darurat Umum</h3>
                <p class="text-md my-2 flex items-center"><i class="bx bx-phone-call mr-2"></i> Telepon: 112</p>
            </div>
            <div class="p-3 bg-white rounded transition duration-300 transform hover:scale-100 hover:bg-[#E3EBF3] hover:text-[#130D19]">
                <h3 class="text-lg font-semibold">Layanan Ambulans</h3>
                <p class="text-md my-2 flex items-center"><i class="bx bxs-ambulance mr-2"></i> Telepon: 119</p>
            </div>
            <div class="p-3 bg-white rounded transition duration-300 transform hover:scale-100 hover:bg-[#E3EBF3] hover:text-[#130D19]">
                <h3 class="text-lg font-semibold">Kontak Klinik</h3>
                <p class="text-md my-2 flex items-center"><i class="bx bx-phone mr-2"></i> Telepon: +62 21 123456</p>
                <p class="text-md flex items-center"><i class="bx bx-envelope mr-2"></i> Email: info@klinikexample.com</p>
            </div>
        </div>
    </div>
</div>
@endsection