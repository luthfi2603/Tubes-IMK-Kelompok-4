@extends('layouts.main')

@section('container')

<div class="container mx-auto p-2">
    <div class="bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-[#222C67] px-6 pt-6">Detail Rekam Medis</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6">

            <!-- Patient Information Card -->
            <div class="border border-gray-200 rounded-lg p-6 bg-[#E3EBF3] shadow-sm">
                <h3 class="text-xl font-semibold mb-4 text-[#222C67] flex items-center">
                    <i class="mr-3 fa-solid fa-bed"></i>
                    Informasi Pasien
                </h3>   
                <p class="mb-2"><strong>Name:</strong> John Doe</p>
                <p class="mb-2"><strong>Date of Birth:</strong> 1990-01-01</p>
                <p class="mb-2"><strong>Gender:</strong> Male</p>
                <p class="mb-2"><strong>Contact:</strong> 123-456-7890</p>
                <p class="mb-2"><strong>Email:</strong> john.doe@example.com</p>
                <p><strong>Address:</strong> 123 Main St, City, Country</p>
            </div>

            <!-- Appointment Information Card -->
            <div class="border border-gray-200 rounded-lg p-6 bg-[#E3EBF3] shadow-sm">
                <h3 class="text-xl font-semibold mb-4 text-[#222C67] flex items-center">
                    <i class="mr-3 fa-solid fa-hospital-user"></i>
                    Informasi Janji Temu
                </h3>
                <p class="mb-2"><strong>Date:</strong> 2024-05-01</p>
                <p class="mb-2"><strong>Time:</strong> 10:00 AM</p>
                <p class="mb-2"><strong>Doctor:</strong> Dr. Sarah Mdith</p>
                <p class="mb-2"><strong>Reason for Visit:</strong> Regular Check-up</p>
                <p><strong>Status:</strong> Completed</p>
            </div>
            
            <!-- Medical Information Card -->
            <div class="border border-gray-200 rounded-lg p-6 bg-[#E3EBF3] shadow-sm">
                <h3 class="text-xl font-semibold mb-4 text-[#222C67] flex items-center">
                    <i class="mr-3 fa-solid fa-pills"></i>
                    Informasi Obat
                </h3>
                <p class="mb-2"><strong>Diagnosis:</strong> TBC</p>
                <p class="mb-2"><strong>Prescriptions:</strong> Medication A, Medication B</p>
                <p><strong>Notes:</strong> Follow-up in two weeks.</p>
            </div>
            <!-- Additional Information Card -->
            <div class="border border-gray-200 rounded-lg p-6 bg-[#E3EBF3] shadow-sm">
                <h3 class="text-xl font-semibold mb-4 text-[#222C67] flex items-center">
                    <i class="mr-3 fa-solid fa-bars"></i>
                    Informasi Tambahan
                </h3>
                <p class="mb-2"><strong>Allergies:</strong> None</p>
                <p class="mb-2"><strong>Previous Visits:</strong> Last visit on 2023-11-10 for flu</p>
                <p><strong>Special Notes:</strong> Patient should follow a balanced diet and exercise regularly.</p>
            </div>
        </div>
                    
        <!-- Actions Section -->
        <div class="mt-8 flex space-x-4 px-6 pb-6">

            <button class="bg-[#E8C51C] text-white p-3 rounded shadow hover:bg-[#B42223] flex items-center">
                <i class="mr-3 fa-solid fa-download"></i>
                Download Report
            </button>

            <button class="bg-[#222C67] text-white p-3 rounded shadow hover:bg-[#130D19] flex items-center">
                <i class="mr-3 fa-solid fa-chevron-down"></i>
                Edit Report
            </button>
            
            <button class="bg-[#B42223] text-white p-3 rounded shadow hover:bg-[#130D19] flex items-center">
                <i class="mr-3 fa-solid fa-trash-alt"></i>
                Hapus Report
            </button>
        </div>

    </div>
</div>

            


@endsection
