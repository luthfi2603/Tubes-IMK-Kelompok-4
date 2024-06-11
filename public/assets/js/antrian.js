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

    successJs.classList.remove('hidden');
    successJs.innerHTML = 'Data berhasil dimuat ulang';
    setTimeout(() => {
        successJs.classList.add('hidden');
        successJs.innerHTML = null;
    }, 2000);
});

async function refreshTable(){
    try {
        const response = await fetch('/admin/antrian/tanggal', {
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
            isiTabelString = '';
            i = 1;

            data.antrians.forEach(item => {
                isiTabelString += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${i}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <div class="dropdown" data-placement="right">
                                ${(() => {
                                    if(item.status == 'Menunggu'){
                                        return `<button class="dropdown-toggle bg-blue-500 text-white px-3 py-1 mr-2 rounded-lg tombol-ubah" id="${item.id}">`;
                                    }else{
                                        return `<button class="dropdown-toggle bg-blue-300 text-white px-3 py-1 mr-2 rounded-lg tombol-ubah" disabled>`;
                                    }
                                })()}
                                    Ubah
                                </button>
                                <div class="dropdown-menu hidden p-4 rounded-lg bg-[#F5F5F5]">
                                    <button id="selesai" class="bg-green-100 text-green-800 text-sm px-2 py-1 leading-5 font-semibold rounded-lg w-full mt-2">
                                        Selesai
                                    </button> <br>
                                    <button id="batal" class="bg-red-100 text-red-800 text-sm px-2 py-1 leading-5 font-semibold rounded-lg w-full mt-2">
                                        Batal
                                    </button>
                                </div>
                            </div>
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
                        <td class="px-6 py-4 whitespace-nowrap text-md">
                            ${(() => {
                                if(item.status == 'Selesai'){
                                    return `<span class="bg-green-100 text-green-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Selesai</span>`;
                                }else if(item.status == 'Menunggu'){
                                    return `<span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Menunggu</span>`;
                                }else{
                                    return `<span class="bg-red-100 text-red-800 text-sm px-2 py-1 inline-flex leading-5 font-semibold rounded-full">Batal</span>`;
                                }
                            })()}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.nama_pasien}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.nama_dokter}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            ${(() => {
                                if(item.waktu_rekomendasi){
                                    return item.waktu_rekomendasi;
                                    // return item.waktu_rekomendasi.substring(0, 5);
                                }else{
                                    return '';
                                }
                            })()}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.nomor_handphone}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.alamat}</td>
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

            isiTabel.querySelectorAll('.dropdown').forEach(function(item, index){
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
                    <td colspan="9" class="py-3">
                        <div role="status" class="flex justify-center">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </td>
                </tr>
            `;
            setTimeout(() => {
                isiTabel.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-2xl py-3">Data tidak ada</td>
                    </tr>
                `;
            }, 1000);
        }
    }catch(error){
        console.error(error);
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
            ubahStatus('Selesai');
        });
        
        batal[i].addEventListener('click', () => {
            ubahStatus('Batal');
        });
    }
};

renderTombolUbah(document);

async function ubahStatus(status){
    try {
        const response = await fetch('/admin/antrian/update', {
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
            successJs.innerHTML = data.success;
            setTimeout(() => {
                successJs.classList.add('hidden');
                successJs.innerHTML = null;
            }, 2000);
        }else{
            failedJs.classList.remove('hidden');
            failedJs.innerHTML = data.failed;
            setTimeout(() => {
                failedJs.classList.add('hidden');
                failedJs.innerHTML = null;
            }, 3000);
        }

        refreshTable();
    }catch(error){
        console.error(error);
    }
};

// setInterval(refreshTable, 2500);