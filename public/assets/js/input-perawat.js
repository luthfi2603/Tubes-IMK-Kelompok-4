const tombolPilihFoto = document.getElementById('tombol-pilih-foto');
const tombolHapusFoto = document.getElementById('tombol-hapus-foto');
const inputFoto = document.getElementById('foto');
const tampilkanFoto = document.getElementById('tampilkan-foto');
const divFoto = document.getElementById('div-foto');
const defaultIcon = document.getElementById('ikon-bawaan');
const errorMessage = document.getElementById('error-message');

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
                tampilkanFoto.src = e.target.result;
                divFoto.classList.remove('hidden');
                defaultIcon.classList.add('hidden');
                errorMessage.classList.add('hidden');
                tombolHapusFoto.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            errorMessage.textContent = "File harus berupa gambar (jpeg, png, jpg) dan ukurannya tidak boleh lebih dari 2 MB.";
            errorMessage.classList.remove('hidden');
            inputFoto.value = null;
            divFoto.classList.add('hidden');
            defaultIcon.classList.remove('hidden');
            tombolHapusFoto.classList.add('hidden');
        }
    }
});

tombolHapusFoto.addEventListener('click', () => {
    inputFoto.value = null;
    divFoto.classList.add('hidden');
    defaultIcon.classList.remove('hidden');
    tombolHapusFoto.classList.add('hidden');
});