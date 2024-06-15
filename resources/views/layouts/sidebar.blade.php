<li class="mb-1 group">
    <a href="{{ route('pasien.dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dashboard') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-house mr-3 text-lg"></i>
        <span class="text-md">Dashboard</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('dokter') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('dokter') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-user-doctor mr-4 text-lg"></i>
        <span class="text-md">Dokter</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('reservasi') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('reservasi*') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-calendar-day mr-4 text-lg"></i>
        <span class="text-md">Reservasi</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('pasien.notifikasi-pasien') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('notifikasi*') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-bell mr-4 text-lg"></i>
        <span class="text-md">Notifikasi</span>
        <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('rekam.medis') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('rekam-medis*') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="fa-solid fa-notes-medical mr-3 text-lg"></i>               
        <span class="text-md">Rekam Medis</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('pasien.tentang-kami') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md {{ request()->is('tentang-kami*') ? 'bg-[#222C67] text-white' : '' }}" id="mom-link">
        <i class="fa-solid fa-address-card mr-3 text-lg"></i>
        <span class="text-md">Tentang Kami</span>
        <i class="ri-arrow-right-s-line ml-auto transition-transform duration-200"></i>
    </a>
    <ul class="pl-7 mt-2 hidden" id="child-link">
        <li class="mb-4">
            <a href="{{ route('pasien.tentang-kami') }}#peta-lokasi" class="text-gray-900 text-md font-semibold flex items-center hover:font-bold hover:text-[#222C67]">Peta dan Lokasi</a>
        </li> 
        <li class="mb-4">
            <a href="{{ route('pasien.tentang-kami') }}#kontak-darurat" class="text-gray-900 text-md font-semibold flex items-center hover:font-bold hover:text-[#222C67]">Kontak Darurat</a>
        </li> 
    </ul>
</li>