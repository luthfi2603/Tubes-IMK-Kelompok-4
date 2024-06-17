const inputTanggal = document.getElementById('tanggal');
const isiTabel = document.getElementById('isi-tabel');
// const pagination = document.getElementById('pagination');
const successJs = document.getElementById('success-js');
const failedJs = document.getElementById('failed-js');
const tombolRefresh = document.getElementById('tombol-refresh');

const today = new Date();
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0');
const dd = String(today.getDate()).padStart(2, '0');

const todayDate = `${yyyy}-${mm}-${dd}`;

inputTanggal.value = todayDate;

let i = 1;
let isiTabelString = '';

inputTanggal.addEventListener('change', () => {
    refreshTable();

    // pagination.remove();
});

tombolRefresh.addEventListener('click', () => {
    refreshTable();
});

async function refreshTable(){
    try {
        isiTabel.innerHTML = `
            <tr>
                <td colspan="7" class="py-3">
                    <div role="status" class="flex justify-center">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>
        `;

        const response = await fetch('/dokter/antrian/tanggal', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
                'tanggal': inputTanggal.value
            })
        });
    
        const data = await response.json();
        
        if(data.antrians.length){ // kalau ada
            isiTabel.innerHTML = '';
            isiTabelString = '';
            i = 1;

            data.antrians.forEach(item => {
                isiTabelString += `
                    <tr class="bg-white hover:bg-[#d1e4f2] transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${i}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md">
                            ${(() => {
                                if(item.id_rekam_medis){
                                    return `
                                        <a class="px-4 py-2 bg-green-300 text-white rounded-lg" disabled>
                                            Rekam medis telah dibuat
                                        </a>
                                    `;
                                }else{
                                    const todayDateObj = new Date(todayDate);
                                    const inputDateObj = new Date(inputTanggal.value);

                                    if(inputDateObj > todayDateObj){
                                        return `
                                            <a class="px-4 py-2 bg-yellow-300 text-white rounded-lg" disabled>
                                                Rekam medis belum bisa dibuat
                                            </a>
                                        `;
                                    }else{
                                        if(item.status == 'Batal'){
                                            return `
                                                <a class="px-4 py-2 bg-red-300 text-white rounded-lg" disabled>
                                                    Reservasi dibatalkan
                                                </a>
                                            `;
                                        }else{
                                            return `
                                                <a href="/dokter/janji-temu-dokter/rekam-medis/create/${item.id}" class="px-4 py-2 bg-green-500 hover:bg-green-700 w-min text-white rounded-lg flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Rekam Medis
                                                </a>
                                            `;
                                        }
                                    }
                                }
                            })()}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            ${(() => {
                                if (item.foto) {
                                    return `
                                        <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                            <img src="../storage/${item.foto}" alt="perawat" class="object-cover object-top w-full h-full">
                                        </div>
                                    `;
                                } else {
                                    return `
                                        <div class="w-20 h-20">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  fill="none"  stroke="#222c67"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                                        </div>
                                    `;
                                }
                            })()}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-blue-500">${item.nama_pasien}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-center">
                            <span class="px-4 py-1 inline-flex text-md leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            ${(() => {
                                if(item.jenis_kelamin == 'L'){
                                    return 'Laki-laki';
                                }else{
                                    return 'Perempuan';
                                }
                            })()}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.umur}</td>  
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.nomor_handphone}</td>         
                    </tr>
                `;

                i++;
            });

            isiTabel.innerHTML = isiTabelString;
        }else{ // kalau tidak ada
            isiTabel.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-3">
                        <div class="bg-gray-100 rounded-lg p-4 inline-flex items-center text-gray-500 ">
                            <i class="fa-regular fa-file mr-3"></i>  
                            <span class="text-lg font-semibold">Data tidak ada</span>
                        </div>
                    </td>
                </tr>
            `;
        }
    }catch(error){
        console.error(error);
    }
};