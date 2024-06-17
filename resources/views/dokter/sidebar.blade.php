<li class="mb-1 group">
    <a href="{{ route('dokter.dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dokter/dashboard') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-house mr-3 text-lg"></i>
        <span class="text-md">Dashboard</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('dokter.janji.temu') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dokter/janji-temu-dokter*') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-calendar-day mr-4 text-lg"></i>
        <span class="text-md">Daftar Reservasi</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('dokter.rekam.medis') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dokter/rekam-medis*') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-notes-medical mr-3 text-lg"></i>
        <span class="text-md">Daftar Rekam Medis</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('dokter.dokter.kami') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dokter/dokter-kami') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-user-doctor mr-4 text-lg"></i>
        <span class="text-md">Dokter Kami</span>
    </a>
</li>
{{-- <li class="mb-1 group">
    <a href="{{ route('dokter.setting-dokter') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dokter/setting-dokter') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-gear mr-3 text-lg"></i>             
        <span class="text-md">Settings</span>
    </a>
</li> --}}