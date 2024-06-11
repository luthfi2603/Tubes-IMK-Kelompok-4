const inputTanggal = document.getElementById('tanggal');
const isiTabel = document.getElementById('isi-tabel');
// const pagination = document.getElementById('pagination');
const successJs = document.getElementById('success-js');
const failedJs = document.getElementById('failed-js');

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

inputTanggal.addEventListener('click', () => {
    refreshTable();
});

async function refreshTable(){
    try {
        const response = await fetch('/dokter/rekam-medis/tanggal', {
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
        console.log(data)
        if(data.rekammedis.length){ // kalau ada
            isiTabel.innerHTML = '';
            isiTabelString = '';
            i = 1;

            data.rekammedis.forEach(item => {
                isiTabelString += `
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${i}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">
                            <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="Avatar">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.nama_pasien}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-900">${item.diagnosa}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md">
                            <a href="/dokter/rekam-medis/detail/${item.id}">
                            <button class="bg-blue-500 text-white px-3 py-1 mr-2 rounded">Detail</button>
                            </a>
                            <button class="bg-[#E8C51C] text-white px-3 py-1 rounded">Unduh</button>
                        </td>
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
        const response = await fetch('/dokter/rekam-medis/tanggal', {
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