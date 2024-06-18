<li class="mb-1 group">
    <a href="{{ route('perawat.dashboard') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('perawat/dashboard') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-house mr-3 text-lg"></i>
        <span class="text-md">Dashboard</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('index.antrian') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('antrian*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-users-line mr-3 text-lg"></i>
        <span class="text-md">Antrian</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('perawat.data.pasien') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('perawat/pasien*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-hospital-user mr-3 text-lg"></i>
        <span class="text-sm">Data Pasien</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('perawat.index.dokter') }}" class="flex font-semibold items-center py-2 px-4 dark:text-gray-400 text-gray-900 hover:bg-[#222C67] dark:hover:text-gray-50 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('perawat/dokter*') ? 'bg-[#222C67] text-white dark:text-white' : '' }}">
        <i class="fa-solid fa-user-doctor mr-3 text-lg"></i>        
        <span class="text-sm">Data Dokter</span>
    </a>
</li>