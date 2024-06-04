const inputTanggal = document.getElementById('tanggal');
const isiTabel = document.getElementById('isi-tabel');
// const pagination = document.getElementById('pagination');
const successJs = document.getElementById('success-js');

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

const refreshTable = async () => {
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
                                <button class="dropdown-toggle bg-blue-500 text-white px-3 py-1 mr-2 rounded-lg
                                    ${(() => {
                                        if(item.status == 'Selesai' || item.status == 'Batal'){
                                            return 'bg-blue-300';
                                        }
                                    })()}
                                    " id="${item.id}"
                                    ${(() => {
                                        if(item.status == 'Selesai' || item.status == 'Batal'){
                                            return 'disabled';
                                        }
                                    })()}
                                >Ubah</button>
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

            const tombolUbah = isiTabel.querySelectorAll('.bg-blue-500.text-white');
            const selesai = isiTabel.querySelectorAll('#selesai');
            const batal = isiTabel.querySelectorAll('#batal');

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
const tombolUbah = document.querySelectorAll('.bg-blue-500.text-white');
const selesai = document.querySelectorAll('#selesai');
const batal = document.querySelectorAll('#batal');

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

const ubahStatus = async (status) => {
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

        if(response.ok){
            successJs.classList.remove('hidden');
            setTimeout(() => {
                successJs.classList.add('hidden');
            }, 2000);
        }

        refreshTable();
    }catch(error){
        console.error(error);
    }
};