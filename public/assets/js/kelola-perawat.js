const cari = document.getElementById('cari');
const isiTabel = document.getElementById('isi-tabel');
const pagination = document.getElementById('pagination');
// const loadingPerawat = document.getElementById('loading-perawat');

const trNull = document.createElement('tr');
const tdNull = document.createElement('td');
tdNull.setAttribute('colspan', 7);
tdNull.innerHTML = 'Data Tidak Ditemukan';
tdNull.classList.add('text-center');
tdNull.classList.add('text-xl');
tdNull.classList.add('py-3');
trNull.appendChild(tdNull);

let i = 1;
let isiTabelString = '';
let statusCariPerawat = false;

const cariData = async () => {
    try {
        // loadingPerawat.classList.toggle('hidden');

        const response = await fetch('/admin/cari/perawat', {
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
    
        if(data.perawats.length){ // kalau ada yang dicari
            isiTabel.innerHTML = '';
            isiTabelString = '';
            i = 1;
            statusCariPerawat = false;
            if(cari.value == ''){
                statusCariPerawat = true;
            }

            data.perawats.forEach(item => {
                isiTabelString += `
                    <tr>
                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">${i}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                            <a href="/admin/perawat/edit/${item.nomor_handphone}">Ubah</a>
                            <form action="/admin/perawat/destroy/${item.id_user}" method="POST">
                                <input name="_token" value="${csrf}" type="hidden">
                                <input name="_method" value="DELETE" type="hidden">
                                <button>Hapus</button>
                            </form>
                        </td>
                        <td class="px-4 py-2 text-gray-700">
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
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.nama}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.nomor_handphone}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.jenis_kelamin}</td>
                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">${item.alamat}</td>
                    </tr>
                `;

                i++;
            });

            isiTabel.innerHTML = isiTabelString;
        }else{ // kalau ga ada yang dicari
            isiTabel.innerHTML = '';
            isiTabel.appendChild(trNull);

            statusCariPerawat = true;
        }
    }catch(error){
        console.error(error);
    }/* finally{
        loadingPerawat.classList.toggle('hidden');
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