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
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 p-4">
                <h1 class="text-3xl font-bold mb-2">Solusi Kesehatan Anda</h1>
                <p class="text-lg mb-4">Kami menyediakan layanan kesehatan terbaik untuk memenuhi kebutuhan Anda. Dari pemeriksaan rutin hingga konsultasi spesialis, kami siap membantu Anda.</p>
                <div class="flex space-x-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Pelajari Lebih Lanjut</button>
                    <button class="bg-gray-200 text-blue-600 px-4 py-2 rounded-full">Hubungi Kami</button>
                </div>
            </div>
            <div class="lg:w-1/2 p-4">
                <img src="https://via.placeholder.com/400" alt="Healthcare Illustration" class="w-full rounded-lg shadow-md">
            </div>
        </div>
    </div>
    <!-- Map and Clinic Location -->
    <div id="peta-lokasi" class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Peta dan Lokasi Klinik</h2>
        <div class="aspect-w-16 aspect-h-9 mb-4">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3164.694249242106!2d-122.08424968469253!3d37.42206597982525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb5a6b2c9e3d7%3A0xa69f48db714b2c18!2sGoogleplex!5e0!3m2!1sen!2sus!4v1633261592432!5m2!1sen!2sus" 
                class="w-full h-full rounded-lg" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
        <p class="text-lg">Alamat Klinik: Jl. Kesehatan No. 123, Jakarta, Indonesia</p>
    </div>
    <!-- Emergency Contacts -->
    <div id="kontak-darurat" class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Kontak Darurat</h2>
        <div class="space-y-4">
            <div>
                <h3 class="text-lg font-semibold">Nomor Darurat Umum</h3>
                <p class="text-sm">Telepon: 112</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold">Layanan Ambulans</h3>
                <p class="text-sm">Telepon: 119</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold">Kontak Klinik</h3>
                <p class="text-sm">Telepon: +62 21 123456</p>
                <p class="text-sm">Email: info@klinikexample.com</p>
            </div>
        </div>
    </div>
    <!-- Feedback and Reviews -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Feedback dan Ulasan</h2>
        <form class="space-y-4">
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select id="rating" name="rating" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option>1 - Sangat Buruk</option>
                    <option>2 - Buruk</option>
                    <option>3 - Cukup</option>
                    <option>4 - Baik</option>
                    <option>5 - Sangat Baik</option>
                </select>
            </div>
            <div>
                <label for="comments" class="block text-sm font-medium text-gray-700">Komentar</label>
                <textarea id="comments" name="comments" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Kirim Feedback</button>
            </div>
        </form>
    </div>
</div>
@endsection