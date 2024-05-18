@extends('layouts.main-dokter')

@section('container')
<div class="flex flex-col lg:flex-row w-full p-4 space-y-6 lg:space-y-0 lg:space-x-6">
    <!-- Main Content -->
    <div class="flex-1">
        <div class="bg-[#222C67] p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center">
                <div class="font-body text-white">
                    <h1 class="text-xl font-bold text-white py-2">Welcome back,</h1>
                    <h2 class="text-2xl font-semibold font-body text-white py-2">Dr Siti Nurhaji</h2>
                    <p class="text-white py-1">MD, DM (Cardiology), FACC, FESC</p>
                    <p class="pt-3 pb-1">You have total <span class="font-bold text-[#E8C51C]">12 Appointments</span> today!</p>
                </div>
                <div>
                    <img src="{{ asset('assets/img/female-doctor.png') }}" alt="Doctor Avatar" class="w-full h-40">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Report</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-4xl font-bold text-blue-800">105</div>
                            <div>
                                <p class="text-gray-600">Total Patient</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-red-100 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-4xl font-bold text-red-800">89</div>
                            <div>
                                <p class="text-gray-600">Consultation</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="text-4xl font-bold text-yellow-800">72</div>
                            <div>
                                <p class="text-gray-600">Rawat Inap & Jalan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Patients</h3>
                <canvas id="patientsChart"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Gender</h3>
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Your Appointments</h3>
            <div>
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h4 class="font-semibold">July, 2023</h4>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 bg-gray-200 rounded-lg">&lt;</button>
                        <button class="p-2 bg-gray-200 rounded-lg">&gt;</button>
                    </div>
                </div>
                <div class="grid grid-cols-7 gap-2 mb-4">
                    <div class="text-center text-gray-600">Mon</div>
                    <div class="text-center text-gray-600">Tue</div>
                    <div class="text-center text-gray-600">Wed</div>
                    <div class="text-center text-gray-600">Thu</div>
                    <div class="text-center text-gray-600">Fri</div>
                    <div class="text-center text-gray-600">Sat</div>
                    <div class="text-center text-gray-600">Sun</div>
                    <!-- Dates -->
                    <!-- Add the dates for the calendar here -->
                    <!-- Use the bg-blue-200 class to highlight the current date -->
                    <div class="text-center">28</div>
                    <div class="text-center">29</div>
                    <div class="text-center">30</div>
                    <div class="text-center">31</div>
                    <div class="text-center">1</div>
                    <div class="text-center">2</div>
                    <div class="text-center">3</div>
                    <div class="text-center">4</div>
                    <div class="text-center">5</div>
                    <div class="text-center">6</div>
                    <div class="text-center">7</div>
                    <div class="text-center">8</div>
                    <div class="text-center">9</div>
                    <div class="text-center">10</div>
                    <div class="text-center">11</div>
                    <div class="text-center">12</div>
                    <div class="text-center">13</div>
                    <div class="text-center">14</div>
                    <div class="text-center">15</div>
                    <div class="text-center">16</div>
                    <div class="text-center">17</div>
                    <div class="text-center">18</div>
                    <div class="text-center">19</div>
                    <div class="text-center">20</div>
                    <div class="text-center">21</div>
                    <div class="text-center">22</div>
                    <div class="text-center bg-blue-200 rounded-lg">23</div>
                    <div class="text-center">24</div>
                    <div class="text-center">25</div>
                    <div class="text-center">26</div>
                    <div class="text-center">27</div>
                    <div class="text-center">28</div>
                    <div class="text-center">29</div>
                    <div class="text-center">30</div>
                    <div class="text-center">31</div>
                </div>
            </div>
        </div>
                <div>
                    <div class="flex items-center justify-between bg-blue-100 p-3 rounded-lg mb-2">
                        <div>
                            <h4 class="font-semibold">Brian Matthew Ufi</h4>
                            <p class="text-gray-600">10:00 am - 11:00 am</p>
                        </div>
                        <button class="p-2 bg-blue-600 text-white rounded-lg">></button>
                    </div>
                    <div class="flex items-center justify-between bg-red-100 p-3 rounded-lg mb-2">
                        <div>
                            <h4 class="font-semibold">Brian Matthew Ufi</h4>
                            <p class="text-gray-600">10:00 am - 11:00 am</p>
                        </div>
                        <button class="p-2 bg-red-600 text-white rounded-lg">></button>
                    </div>
                    <div class="flex items-center justify-between bg-yellow-100 p-3 rounded-lg mb-2">
                        <div>
                            <h4 class="font-semibold">Brian Matthew Ufi</h4>
                            <p class="text-gray-600">10:00 am - 11:00 am</p>
                        </div>
                        <button class="p-2 bg-yellow-600 text-white rounded-lg">></button>
                    </div>
                    <div class="flex items-center justify-between bg-green-100 p-3 rounded-lg mb-2">
                        <div>
                            <h4 class="font-semibold">Brian Matthew Ufi</h4>
                            <p class="text-gray-600">10:00 am - 11:00 am</p>
                        </div>
                        <button class="p-2 bg-green-600 text-white rounded-lg">></button>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="p-2 bg-gray-300 rounded-lg">View All Appointments</button>
                </div>
            </div>
        
    
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('patientsChart').getContext('2d');
    const ctx2 = document.getElementById('genderChart').getContext('2d');

    const patientsChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['0', '1', '2', '3', '4', '5', '6'],
            datasets: [
                {
                    label: 'This Week',
                    data: [105, 100, 120, 90, 85, 140, 160],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    const genderChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Men', 'Women'],
            datasets: [
                {
                    label: 'Gender',
                    data: [170, 140],
                    backgroundColor: ['rgba(59, 130, 246, 1)', 'rgba(252, 165, 165, 1)'],
                },
            ],
        },
        options: {
            responsive: true,
        },
    });
</script>

@endsection