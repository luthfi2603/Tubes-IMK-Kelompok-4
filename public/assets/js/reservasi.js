const inputTanggal = document.getElementById('tanggal');
const inputSpesialis = document.getElementById('spesialis');
const inputDokter = document.getElementById('dokter');
const hariHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
const informasiHari = document.getElementById('informasi-hari');
let hariDiPilih = '';
let spesialisDiPilih = '';

const today = new Date();
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0');
const dd = String(today.getDate()).padStart(2, '0');

const todayDate = `${yyyy}-${mm}-${dd}`;

inputTanggal.setAttribute('min', todayDate);

inputTanggal.addEventListener('change', () => {
    const date = new Date(inputTanggal.value);
    hariDiPilih = hariHari[date.getDay()];
    informasiHari.innerHTML = `Hari yang dipilih adalah hari ${hariDiPilih}`;
    informasiHari.classList.remove('hidden');

    cekInput();
});

inputSpesialis.addEventListener('change', () => {
    spesialisDiPilih = inputSpesialis.value;

    cekInput();
});

const cekInput = () => {
    if(inputTanggal.value && inputSpesialis.value){
        inputDokter.disabled = false;

        daftarDokter();
    }else{
        inputDokter.disabled = true;
        inputDokter.innerHTML = '<option value="">Pilih Tanggal dan Spesialis Dulu</option>';
    }
}

const daftarDokter =  async () => {
    const form = document.createElement('form');
    const inputCsrf = document.createElement('input');
    inputCsrf.setAttribute('name', '_token');
    inputCsrf.value = csrf;
    form.appendChild(inputCsrf);
    const inputHariDiPilih = document.createElement('input');
    inputHariDiPilih.setAttribute('name', 'hari');
    inputHariDiPilih.value = hariDiPilih;
    form.appendChild(inputHariDiPilih);
    const inputSpesialisDiPilih = document.createElement('input');
    inputSpesialisDiPilih.setAttribute('name', 'spesialis');
    inputSpesialisDiPilih.value = spesialisDiPilih;
    form.appendChild(inputSpesialisDiPilih);

    const formData = new FormData(form);
    const response = await fetch('/daftar-dokter', {
        method: "POST",
        body: formData
    });

    try {
        const data = await response.json();

        if(data.dokters.length){
            inputDokter.innerHTML = '<option value="">Pilih Dokter</option>';
            data.dokters.forEach(item => {
                const option = document.createElement('option');
                if(nama && waktu){
                    if(item.nama == nama && item.jam == waktu){
                        option.selected = true;
                    }
                }
                option.value = item.nama + '|' + item.jam;
                option.textContent = item.nama + ' - ' + item.jam;
                inputDokter.appendChild(option);
            });
        }else{
            inputDokter.disabled = true;
            inputDokter.innerHTML = '<option value="">Dokter Tidak Tersedia</option>';
        }
    }catch(error){
        console.error(error);
    }
};

if(inputTanggal.value && inputSpesialis.value){
    const date = new Date(inputTanggal.value);
    hariDiPilih = hariHari[date.getDay()];
    informasiHari.innerHTML = `Hari yang dipilih adalah hari ${hariDiPilih}`;
    informasiHari.classList.remove('hidden');
    inputDokter.disabled = false;

    spesialisDiPilih = inputSpesialis.value;

    daftarDokter();
}

if(inputSpesialis.value){
    spesialisDiPilih = inputSpesialis.value;
}

if(inputTanggal.value){
    const date = new Date(inputTanggal.value);
    hariDiPilih = hariHari[date.getDay()];
    informasiHari.innerHTML = `Hari yang dipilih adalah hari ${hariDiPilih}`;
    informasiHari.classList.remove('hidden');
}