const tombolPilihFoto = document.getElementById('tombol-pilih-foto');
const tombolHapusFoto = document.getElementById('tombol-hapus-foto');
const tombolHapusFotoTidakAdaFoto = document.getElementById('tombol-hapus-foto-tidak-ada-foto');
const tombolBatal = document.getElementById('tombol-batal');
const inputFoto = document.getElementById('foto');
const tampilkanFoto = document.getElementById('tampilkan-foto');
const divFoto = document.getElementById('div-foto');
const divFotoLama = document.getElementById('div-foto-lama');
const defaultIcon = document.getElementById('ikon-bawaan');
const errorMessage = document.getElementById('error-message');
const hapus = document.getElementById('hapus');

tombolPilihFoto.addEventListener('click', () => {
    inputFoto.click();
});

inputFoto.addEventListener('change', () => {
    const file = inputFoto.files[0];

    if (file) {
        const fileType = file.type;
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 2 * 1024 * 1024;

        if (validImageTypes.includes(fileType) && file.size <= maxSize) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if(divFotoLama){
                    divFotoLama.classList.add('hidden');
                }
                tampilkanFoto.src = e.target.result;
                divFoto.classList.remove('hidden');
                defaultIcon.classList.add('hidden');
                errorMessage.classList.add('hidden');
                if(tombolHapusFoto){
                    tombolHapusFoto.classList.add('hidden');
                }
                if(tombolHapusFotoTidakAdaFoto){
                    tombolHapusFotoTidakAdaFoto.classList.remove('hidden');
                }
                if(tombolBatal){
                    tombolBatal.classList.remove('hidden');
                }
            };
            reader.readAsDataURL(file);
        } else {
            errorMessage.textContent = "File harus berupa gambar (jpeg, png, jpg) dan ukurannya tidak boleh lebih dari 2 MB.";
            errorMessage.classList.remove('hidden');
            inputFoto.value = null;
            divFoto.classList.add('hidden');
            if(tombolHapusFoto){
                tombolHapusFoto.classList.remove('hidden');
            }
            if(tombolHapusFotoTidakAdaFoto){
                tombolHapusFotoTidakAdaFoto.classList.add('hidden');
                defaultIcon.classList.remove('hidden');
            }
            if(divFotoLama){
                divFotoLama.classList.remove('hidden');
            }
        }
    }
});

if(tombolHapusFoto){
    tombolHapusFoto.addEventListener('click', () => {
        inputFoto.value = null;
        divFotoLama.classList.add('hidden');
        defaultIcon.classList.remove('hidden');
        tombolHapusFoto.classList.add('hidden');
        hapus.value = true;
        tombolBatal.classList.remove('hidden');
        errorMessage.classList.add('hidden');
        tombolPilihFoto.classList.add('hidden');
    });
}

if(tombolHapusFotoTidakAdaFoto){
    tombolHapusFotoTidakAdaFoto.addEventListener('click', () => {
        inputFoto.value = null;
        divFoto.classList.add('hidden');
        defaultIcon.classList.remove('hidden');
        tombolHapusFotoTidakAdaFoto.classList.add('hidden');
        errorMessage.classList.add('hidden');
    });
}

if(tombolBatal){
    tombolBatal.addEventListener('click', () => {
        inputFoto.value = null;
        divFoto.classList.add('hidden');
        divFotoLama.classList.remove('hidden');
        tombolBatal.classList.add('hidden');
        tombolHapusFoto.classList.remove('hidden');
        defaultIcon.classList.add('hidden');
        hapus.value = null;
        errorMessage.classList.add('hidden');
        tombolPilihFoto.classList.remove('hidden');
    });
}