@extends('dokter.main')

@section('container')

<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Dokter Kami</h1>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">


<div class="flex-1 p-5">
    <div class="bg-[#222C67] text-white p-4 max-[640px]:p-3 rounded-lg mb-6 flex items-center">
        <div class="flex-1">
            <p class="font-vold text-lg sm:text-md max-[640px]:text-sm">"Kami menyediakan dokter berpengalaman yang siap memberikan perawatan terbaik untuk setiap pasien kami. Kesehatan Anda adalah prioritas utama kami."</p>
        </div>
        <div>
            <img src="{{ asset('assets/img/picture-quotes.png') }}" alt="Doctor" class="w-24 h-25 max-[640px]:w-17 max-[640px]:h-17">
        </div>
    </div>

     <!-- Doctor Cards -->
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col lg:flex-row md:items-center mb-4">
            <img class="w-24 h-24 rounded-full" src="{{ asset('assets/img/doctor-pfp.png') }}" alt="Doctor Avatar">
            <div class="ml-0 md:ml-4 mt-4 md:mt-0 flex-1">
                <h3 class="text-xl font-bold text-blue-500">Dr. Jay Soni</h3>
                <p class="text-gray-600">BDS, MDS</p>
                <div class="flex items-center mt-2">
                    <span class="text-yellow-500">★★★☆☆</span>
                    <span class="text-gray-600 ml-2">(6545 ratings)</span>
                </div>
                <p class="mt-2 text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="text-left lg:text-right mt-4 md:mt-0">
                    <p class="text-gray-600"><i class="fas fa-map-marker-alt"></i> Jalan Budi Luhur No 99</p>
                    <p class="text-gray-600"><i class="fas fa-comments"></i> 176 Feedback</p>
                    <p class="text-gray-600"><i class="fas fa-clock"></i> MON - SAT 10:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
    
       
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col lg:flex-row md:items-center mb-4">
            <img class="w-24 h-24 rounded-full" src="{{ asset('assets/img/doctor-pfp.png') }}" alt="Doctor Avatar">
            <div class="ml-0 md:ml-4 mt-4 md:mt-0 flex-1">
                <h3 class="text-xl font-bold text-blue-500">Dr. Jay Soni</h3>
                <p class="text-gray-600">BDS, MDS</p>
                <div class="flex items-center mt-2">
                    <span class="text-yellow-500">★★★☆☆</span>
                    <span class="text-gray-600 ml-2">(6545 ratings)</span>
                </div>
                <p class="mt-2 text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="text-left lg:text-right mt-4 md:mt-0">
                    <p class="text-gray-600"><i class="fas fa-map-marker-alt"></i> Jalan Budi Luhur No 99</p>
                    <p class="text-gray-600"><i class="fas fa-comments"></i> 176 Feedback</p>
                    <p class="text-gray-600"><i class="fas fa-clock"></i> MON - SAT 10:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
        
        
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col lg:flex-row md:items-center mb-4">
            <img class="w-24 h-24 rounded-full" src="{{ asset('assets/img/doctor-pfp.png') }}" alt="Doctor Avatar">
            <div class="ml-0 md:ml-4 mt-4 md:mt-0 flex-1">
                <h3 class="text-xl font-bold text-blue-500">Dr. Jay Soni</h3>
                <p class="text-gray-600">BDS, MDS</p>
                <div class="flex items-center mt-2">
                    <span class="text-yellow-500">★★★☆☆</span>
                    <span class="text-gray-600 ml-2">(6545 ratings)</span>
                </div>
                <p class="mt-2 text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="text-left lg:text-right mt-4 md:mt-0">
                    <p class="text-gray-600"><i class="fas fa-map-marker-alt"></i> Jalan Budi Luhur No 99</p>
                    <p class="text-gray-600"><i class="fas fa-comments"></i> 176 Feedback</p>
                    <p class="text-gray-600"><i class="fas fa-clock"></i> MON - SAT 10:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
        

        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col lg:flex-row md:items-center mb-4">
            <img class="w-24 h-24 rounded-full" src="{{ asset('assets/img/doctor-pfp.png') }}" alt="Doctor Avatar">
            <div class="ml-0 md:ml-4 mt-4 md:mt-0 flex-1">
                <h3 class="text-xl font-bold text-blue-500">Dr. Jay Soni</h3>
                <p class="text-gray-600">BDS, MDS</p>
                <div class="flex items-center mt-2">
                    <span class="text-yellow-500">★★★☆☆</span>
                    <span class="text-gray-600 ml-2">(6545 ratings)</span>
                </div>
                <p class="mt-2 text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <div class="text-left lg:text-right mt-4 md:mt-0">
                    <p class="text-gray-600"><i class="fas fa-map-marker-alt"></i> Jalan Budi Luhur No 99</p>
                    <p class="text-gray-600"><i class="fas fa-comments"></i> 176 Feedback</p>
                    <p class="text-gray-600"><i class="fas fa-clock"></i> MON - SAT 10:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
        
        
    </div>

    <div class="flex items-center justify-between mt-4 mx-4">
        <div>
            <label for="items-per-page" class="block text-sm font-medium text-gray-700">Items per page:</label>
            <select id="items-per-page" name="items-per-page" class="mt-1 block w-16 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option>5</option>
                <option>10</option>
                <option>15</option>
            </select>
        </div>
        <div class="flex-1 flex justify-end items-center space-x-2">
            <span class="text-sm text-gray-700">1 - 7 of 16</span>
            <button class="px-3 py-1 bg-gray-300 text-gray-700 rounded-lg">Previous</button>
            <button class="px-3 py-1 bg-gray-300 text-gray-700 rounded-lg">Next</button>
        </div>
    </div>
</div>

@endsection
