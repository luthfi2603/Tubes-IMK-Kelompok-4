const cari = document.getElementById('cari');
const isiTabel = document.getElementById('isi-tabel');
const pagination = document.getElementById('pagination');

const trNull = document.createElement('tr');
const tdNull = document.createElement('td');
tdNull.setAttribute('colspan', 4);
tdNull.classList.add('text-center', 'py-3');

const divNull = document.createElement('div');
divNull.classList.add('bg-gray-100', 'dark:bg-gray-800', 'rounded-lg', 'p-4', 'inline-flex', 'items-center', 'text-gray-500', 'dark:text-gray-400');

const iconNull = document.createElement('i');
iconNull.classList.add('fa-regular', 'fa-file', 'mr-3');

const spanNull = document.createElement('span');
spanNull.classList.add('text-lg', 'font-semibold');
spanNull.textContent = 'Data tidak ada';

divNull.appendChild(iconNull);
divNull.appendChild(spanNull);
tdNull.appendChild(divNull);
trNull.appendChild(tdNull);


let i = 1;
let isiTabelString = '';
let statusCariJadwalDokter = false;
let debounceTimer;

async function cariData(){
    try {
        isiTabel.innerHTML = `
            <tr>
                <td colspan="4" class="py-3">
                    <div role="status" class="flex justify-center">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>
        `;

        const response = await fetch('/admin/jadwal-dokter/cari', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
                'kataKunci': cari.value
            })
        });

        const data = await response.json();
    
        if(data.jadwal_dokters.length){ // kalau ada yang dicari
            isiTabel.innerHTML = '';
            isiTabelString = '';
            i = 1;
            statusCariJadwalDokter = false;
            if(cari.value == ''){
                statusCariJadwalDokter = true;
            }

            data.jadwal_dokters.forEach(item => {
                isiTabelString += `
                    <tr class="hover:bg-[#d1e4f2] dark:hover:bg-gray-700 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">${i}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">
                            <div class="flex gap-2">
                                <a href="/admin/jadwal-dokter/edit/${item.id}" class="bg-yellow-400 text-white px-2 py-1 rounded shadow hover:bg-yellow-500 flex items-center">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    Ubah
                                </a>
                                <form onsubmit="hapusJadwalDokter(event)" action="/admin/jadwal-dokter/${item.id}" method="POST">
                                    <input name="_token" value="${csrf}" type="hidden">
                                    <input name="_method" value="DELETE" type="hidden">
                                    <button class="bg-red-500 text-white px-2 py-1 rounded shadow hover:bg-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">${item.hari}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-300">${item.jam}</td>
                    </tr>
                `;

                i++;
            });

            isiTabel.innerHTML = isiTabelString;
        }else{ // kalau ga ada yang dicari
            isiTabel.innerHTML = '';
            isiTabel.appendChild(trNull);

            statusCariJadwalDokter = true;
        }
    }catch(error){
        console.error(error);
    }
};

cari.addEventListener('input', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        cariData();
        
        pagination.remove();
    }, 500);
});

cari.addEventListener('focus', () => {
    document.addEventListener('keydown', (event) => {
        if(event.key === 'Escape'){
            document.body.click();
        }
    });
});