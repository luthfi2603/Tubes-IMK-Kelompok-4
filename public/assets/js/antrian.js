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
            isiTabel.innerHTML = '';
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
                    <td colspan="8" class="text-center text-2xl py-3">Data tidak ada</td>
                </tr>
            `;
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