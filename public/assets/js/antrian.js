const cari = document.getElementById('cari');
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
let failedJsTimeout;
let statusCariAntrian = false;
let debounceTimer;

inputTanggal.addEventListener('change', () => {
    refreshTable();

    // pagination.remove();
});

tombolRefresh.addEventListener('click', () => {
    refreshTable();

    /* successJs.classList.remove('hidden');
    successJs.innerHTML = 'Data berhasil dimuat ulang';
    setTimeout(() => {
        successJs.classList.add('hidden');
        successJs.innerHTML = null;
    }, 2000); */
});

cari.addEventListener('input', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        refreshTable();
    }, 500);
});

async function refreshTable(){
    try {
        isiTabel.innerHTML = `
            <tr>
                <td colspan="9" class="py-3">
                    <div role="status" class="flex justify-center">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>
        `;

        failedJs.classList.add('hidden');
        if(failedJsTimeout){ // ini agar setTimeout tidak terjadi bug langsung ke tutup
            clearTimeout(failedJsTimeout);
        }

        const response = await fetch('/antrian/tanggal', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
                'tanggal': inputTanggal.value,
                'kata_kunci': cari.value
            })
        });

        if(!response.ok){
            throw new Error(`HTTP error! ${response.status} (${response.statusText})`);
        }
    
        const data = await response.json();
        
        if(data.antrians.length){ // kalau ada
            isiTabelString = '';
            i = 1;
            statusCariAntrian = false;

            data.antrians.forEach(item => {
                isiTabelString += `
                    <tr class="bg-white dark:bg-gray-900 hover:bg-[#d1e4f2] dark:hover:bg-gray-700 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">${i}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">
                            <div class="dropdown" data-placement="right">
                                ${(() => {
                                    if(item.status == 'Menunggu'){
                                        const todayDateObj = new Date(todayDate);
                                        const inputDateObj = new Date(inputTanggal.value);

                                        if(inputDateObj > todayDateObj){
                                            return `<button class="dropdown-toggle bg-yellow-300 dark:bg-yellow-400 text-white px-3 py-1 rounded tombol-ubah shadow flex items-center" disabled>`;
                                        }else{
                                            return `<button class="dropdown-toggle bg-yellow-500 dark:bg-yellow-600 text-white px-3 py-1 rounded tombol-ubah shadow flex items-center" id="${item.id}">`;
                                        }
                                    }else{
                                        return `<button class="dropdown-toggle bg-yellow-300 text-white px-3 py-1 rounded tombol-ubah shadow flex items-center" disabled>`;
                                    }
                                })()}
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    Ubah
                                </button>
                                <div class="dropdown-menu hidden p-4 rounded-lg bg-[#F5F5F5] dark:bg-gray-900">
                                    <div class="flex flex-col gap-4">
                                        <button id="selesai" class="bg-green-100 dark:bg-green-600 dark:text-green-200 text-green-800 text-sm px-2 py-1 leading-5 font-semibold rounded shadow w-full">
                                            Selesai
                                        </button>
                                        <button id="batal" class="bg-red-100 dark:bg-red-600 dark:text-red-200 text-red-800 text-sm px-2 py-1 leading-5 font-semibold rounded shadow w-full">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            ${(() => {
                                if (item.foto) {
                                    return `
                                        <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300 dark:border-gray-600">
                                            <img src="../storage/${item.foto}" alt="pasien" class="object-cover object-top w-full h-full">
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
                        <td class="px-6 py-4 whitespace-nowrap text-md">
                            ${(() => {
                                if(item.status == 'Selesai'){
                                    return `<span class="bg-green-100 dark:bg-green-600 dark:text-green-200 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded shadow">Selesai</span>`;
                                }else if(item.status == 'Menunggu'){
                                    return `<span class="bg-yellow-100 dark:bg-yellow-600 dark:text-yellow-200 text-yellow-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded shadow">Menunggu</span>`;
                                }else{
                                    return `<span class="bg-red-100 dark:bg-red-600 dark:text-red-200 text-red-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded shadow">Batal</span>`;
                                }
                            })()}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">${item.nama_pasien}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">${item.nama_dokter}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">
                            ${(() => {
                                if(item.waktu_rekomendasi){
                                    return item.waktu_rekomendasi;
                                    // return item.waktu_rekomendasi.substring(0, 5);
                                }else{
                                    return '';
                                }
                            })()}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">${item.nomor_handphone}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900 dark:text-gray-200">${item.alamat}</td>
                    </tr>
                `;
                /* <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                        ${(() => {
                            let dateObj = new Date(item.updated_at);
                            return dateObj.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
                        })()}
                    </td> */

                i++;
            });

            isiTabel.innerHTML = isiTabelString;

            renderTombolUbah(isiTabel);

            isiTabel.querySelectorAll('.dropdown').forEach((item, index) => {
                const popperId = 'popper-' + index
                const toggle = item.querySelector('.dropdown-toggle')
                const menu = item.querySelector('.dropdown-menu')
                const placement = item.getAttribute('data-placement') || 'bottom-end'
            
                menu.dataset.popperId = popperId
                popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                    modifiers: [
                        {
                            name: 'offset',
                            options: {
                                offset: [0, 8],
                            },
                        },
                        {
                            name: 'preventOverflow',
                            options: {
                                padding: 24,
                            },
                        },
                    ],
                    placement: placement
                });
            })
        }else{ // kalau tidak ada
            isiTabel.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center text-2xl py-3">
                        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 inline-flex items-center text-gray-500 dark:text-gray-400">
                                <i class="fa-regular fa-file mr-3"></i>  
                                <span class="text-lg font-semibold">Data tidak ada</span>
                            </div>
                    </td>
                </tr>
            `;

            statusCariAntrian = true;
        }
    }catch(error){
        failedJs.classList.remove('hidden');
        failedJs.children[1].innerHTML = error.message;
        failedJsTimeout = setTimeout(() => {
            failedJs.classList.add('hidden');
        }, 3000);
    }
};

// ubah status
let id = 0;

function renderTombolUbah(element){
    const tombolUbah = element.querySelectorAll('.tombol-ubah');
    const selesai = element.querySelectorAll('#selesai');
    const batal = element.querySelectorAll('#batal');
    
    for(let i = 0; i < tombolUbah.length; i++){
        tombolUbah[i].addEventListener('click', () => {
            id = tombolUbah[i].getAttribute('id');
        });
    
        selesai[i].addEventListener('click', () => {
            ubahStatusAntrianSelesai();
        });
        
        batal[i].addEventListener('click', () => {
            ubahStatusAntrianBatal();
        });
    }
};

renderTombolUbah(document);

async function ubahStatus(status){
    try {
        const response = await fetch('/antrian/update', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
                '_method': 'PUT',
                'id': id,
                'status': status,
            })
        });

        const data = await response.json();

        if('success' in data){
            successJs.classList.remove('hidden');
            successJs.children[1].innerHTML = data.success;
            setTimeout(() => {
                successJs.classList.add('hidden');
                successJs.children[1].innerHTML = null;
            }, 2000);
        }else{
            failedJs.classList.remove('hidden');
            failedJs.children[1].innerHTML = data.failed;
            setTimeout(() => {
                failedJs.classList.add('hidden');
                failedJs.children[1].innerHTML = null;
            }, 3000);
        }

        refreshTable();
    }catch(error){
        console.error(error);
    }
};

// setInterval(refreshTable, 2500);

cari.addEventListener('blur', () => {
    if(statusCariAntrian){
        cari.value = null;

        refreshTable();
    }
});

cari.addEventListener('focus', () => {
    document.addEventListener('keydown', (event) => {
        if(event.key === 'Escape'){
            if(statusCariAntrian){
                cari.value = null;
        
                refreshTable();
            }
        }
    });
});