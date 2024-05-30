@extends('layouts.main')

@section('container')
    <!-- Dashboard Header -->
<div class="flex justify-between items-center px-4 mb-3">
    <div class="font-body font-bold text-[#222C67]">
        <h1 class="text-3xl font-bold">Dashboard</h1>
    </div>
</div>

<hr class="border-1 border-[#B1B0AF] mb-4 mx-4">

<div class="flex flex-col lg:flex-row w-full p-4 space-y-6 lg:space-y-0 lg:space-x-6">
<!-- Main Content -->
<div class="flex-1">
    <div class="bg-[#222C67] p-6 rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row justify-between items-center max-[760px]:items-start">
            <div class="font-body text-white mb-4 md:mb-0">
                <h1 class="text-xl font-bold text-white py-2">Welcome,</h1>
                <h2 class="text-2xl font-semibold font-body text-white py-2">Najwa Amanda</h2>
                <p class="text-white py-1">"Ingat untuk tetap terhidrasi dan minum obat tepat waktu."</p>
                <button class="mt-4 bg-white font-bold text-blue-600 px-4 py-2 rounded-lg">Buat Janji Temu</button>
            </div>
            <div class="flex-shrink-0">
                <img src="{{ asset('assets/img/patient_illustration.png') }}" alt="Doctor Avatar" class="w-44 h-44 lg:block md:block max-[760px]:hidden">
            </div>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Report</h3>
                <select class="border-gray-300 rounded-lg">
                    <option>This Month</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center space-y-2">
                    <div class="text-4xl font-bold text-blue-800">105</div>
                    <div>
                        <p class="text-gray-600 text-center">Total Pasien</p>
                    </div>
                </div>
                <div class="bg-red-100 p-4 rounded-lg flex flex-col items-center space-y-2">
                    <div class="text-4xl font-bold text-red-800">89</div>
                    <div>
                        <p class="text-gray-600 text-center">Konsultasi</p>
                    </div>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg flex flex-col items-center space-y-2">
                    <div class="text-4xl font-bold text-yellow-800">72</div>
                    <div>
                        <p class="text-gray-600 text-center">Rawat Inap & Jalan</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg h-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Patients</h3>
                <select class="border-gray-300 rounded-lg">
                    <option>This Week</option>
                    
                </select>
            </div>
            <div> 
                <canvas id="patientsChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg h-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Gender</h3>
                <select class="border-gray-300 rounded-lg">
                    <option>2023</option>
                    
                </select>
            </div>
            <canvas id="genderChart"></canvas>
        </div>
    </div>
</div>

<!-- Right Sidebar -->
<div class="w-full lg:w-1/3">
    <div class="bg-white mb-6 w-full pb-4">
        <div class="bg-gray-200 py-3 px-4 rounded-t-lg">
            <h3 class="text-lg font-semibold">Your Appointments</h3>
        </div>
        <hr class="border-gray-300">
        <div class="flex justify-center pb-6 pt-3">
            <div class="w-full max-w-xs mx-auto flex justify-center">
                <div inline-datepicker data-date="02/02/2022"></div>
            </div>
        </div>
    </div>
    
    <div>
        <div class="flex items-center justify-between bg-blue-100 p-3 rounded-lg mb-2">
            <div>
                <h4 class="font-semibold">Brian Matthew Ufi</h4>
                <p class="text-gray-600">10:00 am - 11:00 am</p>
            </div>
            <a href="#">
                <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
            </a>
        </div>
        <div class="flex items-center justify-between bg-red-100 p-3 rounded-lg mb-2">
            <div>
                <h4 class="font-semibold">Brian Matthew Ufi</h4>
                <p class="text-gray-600">10:00 am - 11:00 am</p>
            </div>
            <a href="#">
                <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
            </a>
        </div>
        <div class="flex items-center justify-between bg-yellow-100 p-3 rounded-lg mb-2">
            <div>
                <h4 class="font-semibold">Brian Matthew Ufi</h4>
                <p class="text-gray-600">10:00 am - 11:00 am</p>
            </div>
            <a href="#">
                <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
            </a>
        </div>
        <div class="flex items-center justify-between bg-green-100 p-3 rounded-lg mb-2">
            <div>
                <h4 class="font-semibold">Brian Matthew Ufi</h4>
                <p class="text-gray-600">10:00 am - 11:00 am</p>
            </div>
            <a href="#">
                <i class="fa-solid fa-circle-chevron-right fa-lg p-2 w-full h-full"></i>
            </a>
        </div>
        <div class="text-center mt-4 rounded-lg w-full">
            <button class="p-2 bg-gray-300 rounded-lg">View All Appointments</button>
        </div>
     </div>
    </div>
</div>
@endsection