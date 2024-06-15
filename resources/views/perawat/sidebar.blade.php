<li class="mb-1 group">
    <a href="{{ route('perawat.dashboard') }}" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 {{ request()->is('perawat/dashboard') ? 'bg-[#222C67] text-white' : '' }}">
        <i class="ri-home-2-line mr-3 text-lg"></i>
        <span class="text-md">Dashboard</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('perawat.index.antrian') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('perawat/antrian*') ? 'bg-[#222C67] text-white fill-white' : 'text-gray-900 hover:bg-[#222C67] hover:text-gray-100 hover:fill-white' }}">
        <svg class="mr-1 w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
            <circle cx="22" cy="20" r="10"/>
            <path d="M22,34c-9.39,0-16,4.5-16,9v5h32v-5C38,38.5,31.39,34,22,34z"/>
            <circle cx="36" cy="14" r="8" opacity="0.7"/>
            <path d="M36,24c-7.18,0-12,3.5-12,7v4h24v-4C48,27.5,43.18,24,36,24z" opacity="0.7"/>
            <circle cx="48" cy="10" r="6" opacity="0.5"/>
            <path d="M48,18c-5.39,0-8,2.7-8,5v3h16v-3C56,20.7,53.39,18,48,18z" opacity="0.5"/>
        </svg>
        <span class="text-sm">Antrian</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('perawat.data.pasien') }}" class="flex font-semibold items-center py-2 px-4 rounded-md text-gray-900 hover:bg-[#222C67] hover:text-gray-100 {{ request()->is('perawat/pasien*') ? 'bg-[#222C67] text-white' : '' }}">
        <i class='bx bx-user mr-3 text-lg'></i>
        <span class="text-sm">Kelola Pasien</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('perawat.index.dokter') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('perawat/dokter*') ? 'bg-[#222C67] text-white fill-white' : 'text-gray-900 hover:bg-[#222C67] hover:text-gray-100 hover:fill-white' }}">
        <svg class="mr-3 w-[16px] h-[16px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg>
        <span class="text-sm">Kelola Dokter</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="{{ route('perawat.jadwal.dokter.index') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('perawat/jadwal-dokter*') ? 'bg-[#222C67] text-white fill-white' : 'text-gray-900 hover:bg-[#222C67] hover:text-gray-100 hover:fill-white' }}">
        <svg class="mr-3 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/></svg>
        <span class="text-sm">Kelola Jadwal Dokter</span>
    </a>
</li>
<li class="mb-1 group">
    <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-[#222C67] hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
        <i class='bx bx-bell mr-3 text-lg'></i>
        <span class="text-sm">Notifications</span>
        <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
    </a>
</li>