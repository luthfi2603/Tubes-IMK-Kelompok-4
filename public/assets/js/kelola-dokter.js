const cari = document.getElementById('cari');
const isiTabel = document.getElementById('isi-tabel');
const pagination = document.getElementById('pagination');
// const loadingdokter = document.getElementById('loading-dokter');

const trNull = document.createElement('tr');
const tdNull = document.createElement('td');
tdNull.setAttribute('colspan', 8);
tdNull.innerHTML = 'Data Tidak Ditemukan';
tdNull.classList.add('text-center');
tdNull.classList.add('text-xl');
tdNull.classList.add('py-3');
trNull.appendChild(tdNull);

let i = 1;
let isiTabelString = '';
let statusCariDokter = false;

const cariData = async () => {
    try {
        // loadingdokter.classList.toggle('hidden');

        const response = await fetch('/admin/cari/dokter', {
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
    
        if(data.dokters.length){ // kalau ada yang dicari
            isiTabel.innerHTML = '';
            isiTabelString = '';
            i = 1;
            statusCariDokter = false;
            if(cari.value == ''){
                statusCariDokter = true;
            }

            data.dokters.forEach(item => {
                isiTabelString += `
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">${i}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            <div class="flex gap-2 items-center h-full">
                                <a href="/admin/dokter/edit/${item.nomor_handphone}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg">Ubah</a>
                                <form action="/admin/dokter/destroy/${item.id_user}" method="POST">
                                    <input name="_token" value="${csrf}" type="hidden">
                                    <input name="_method" value="DELETE" type="hidden">
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">Hapus</button>
                                </form>
                            </div>
                        </td>
                        <td class="px-4 py-2 text-gray-700">
                            ${(() => {
                                if (item.foto) {
                                    return `
                                        <div class="w-20 h-20 aspect-square overflow-hidden rounded-full border-2 border-gray-300">
                                            <img src="../storage/${item.foto}" alt="dokter" class="object-cover object-top w-full h-full">
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
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.nama}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.nomor_handphone}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            ${(() => {
                                if(item.jenis_kelamin == 'L'){
                                    return 'Laki-laki'
                                }else{
                                    return 'Perempuan'
                                }
                            })()}
                        </td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.spesialis}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.alamat}</td>
                    </tr>
                `;

                i++;
            });

            isiTabel.innerHTML = isiTabelString;
        }else{ // kalau ga ada yang dicari
            isiTabel.innerHTML = '';
            isiTabel.appendChild(trNull);

            statusCariDokter = true;
        }
    }catch(error){
        console.error(error);
    }/* finally{
        loadingdokter.classList.toggle('hidden');
    } */
};

cari.addEventListener('input', () => {
    cariData();
    
    pagination.remove();
});

cari.addEventListener('focus', () => {
    document.addEventListener('keydown', (event) => {
        if(event.key === 'Escape'){
            document.body.click();
        }
    });
});