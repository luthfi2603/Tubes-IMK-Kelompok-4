const tombolUbahFoto = document.getElementById('ubah-foto');
const inputFoto = document.getElementById('foto');
const tampilkanFoto = document.getElementById('tampilkan-foto');
const errorMessage = document.getElementById('error-message');
const defaultIcon = document.getElementById('ikon-bawaan');
const divFoto = document.getElementById('div-foto');
const tombolHapusFoto = document.getElementById('hapus-foto');
const tombolBatal = document.getElementById('batal');
const tombolSimpan = document.getElementById('simpan');
const successHtml = document.getElementById('success');
const successPhp = document.getElementById('success-php');
const failedPhp = document.getElementById('failed');

tombolUbahFoto.addEventListener('click', () => {
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
                if(tombolHapusFoto != null){
                    tampilkanFoto.src = e.target.result;
                    tombolUbahFoto.classList.add('hidden');
                    tombolHapusFoto.classList.add('hidden');
                    tombolSimpan.classList.remove('hidden');
                    tombolBatal.classList.remove('hidden');
                }else{
                    tampilkanFoto.src = e.target.result;
                    divFoto.classList.remove('hidden');
                    defaultIcon.classList.add('hidden');
                    tombolUbahFoto.classList.add('hidden');
                    tombolSimpan.classList.remove('hidden');
                    tombolBatal.classList.remove('hidden');
                }
                errorMessage.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            errorMessage.textContent = "File harus berupa gambar (jpeg, png, jpg) dan ukurannya tidak boleh lebih dari 2 MB.";
            errorMessage.classList.remove('hidden');
            inputFoto.value = null;
        }
    }
});

tombolBatal.addEventListener('click', () => {
    location.reload();
});

const klikTombolHapusFoto = () => {
    tombolUbahFoto.classList.add('hidden');
    tombolHapusFoto.classList.add('hidden');
    tombolSimpan.classList.remove('hidden');
    tombolBatal.classList.remove('hidden'); 
    defaultIcon.classList.remove('hidden')
    divFoto.classList.add('hidden');
    errorMessage.classList.add('hidden');
    tombolSimpan.setAttribute('onclick', 'hapus()');
};

const simpan =  async (csrf, jenis) => {
    const form = document.createElement('form');
    form.setAttribute('enctype', 'multipart/form-data')
    const inputCsrf = document.createElement('input');
    inputCsrf.setAttribute('name', '_token');
    inputCsrf.value = csrf;
    const methodPut = document.createElement('input');
    methodPut.setAttribute('name', '_method');
    methodPut.value = 'PUT';
    const inputJenis = document.createElement('input');
    inputJenis.setAttribute('name', 'jenis');
    inputJenis.value = jenis;
    inputFoto.setAttribute('name', 'foto');
    form.appendChild(inputCsrf);
    form.appendChild(methodPut);
    form.appendChild(inputJenis);
    form.appendChild(inputFoto);

    const formData = new FormData(form);
    const response = await fetch('/foto-profil', {
        method: "POST",
        body: formData
    });

    try {
        const data = await response.json();

        if('success' in data){
            localStorage.setItem('successMessage', data.success);

            document.location.href = '/profil';
        }else{
            if('foto' in data.errors){
                errorMessage.classList.remove('hidden');
                errorMessage.innerHTML = data.errors.foto;
            }
        }
    }catch(error){
        console.error(error);
    }
};

const hapus =  async () => {
    const form = document.createElement('form');
    const inputCsrf = document.createElement('input');
    inputCsrf.setAttribute('name', '_token');
    inputCsrf.value = csrf;
    const methodPut = document.createElement('input');
    methodPut.setAttribute('name', '_method');
    methodPut.value = 'DELETE';
    form.appendChild(inputCsrf);
    form.appendChild(methodPut);

    const formData = new FormData(form);
    const response = await fetch('/hapus-foto-profil', {
        method: "POST",
        body: formData
    });

    try {
        const data = await response.json();

        if('success' in data){
            localStorage.setItem('successMessage', data.success);

            document.location.href = '/profil';
        }
    }catch(error){
        console.error(error);
    }
};

const successMessage = localStorage.getItem('successMessage');
if(successMessage){
    successHtml.classList.remove('hidden');
    successHtml.innerHTML = successMessage
    
    localStorage.removeItem('successMessage');
    
    setTimeout(() => {
        successHtml.classList.add('hidden');
    }, 3000);
}

if(successPhp){
    setTimeout(() => {
        successPhp.classList.add('hidden');
    }, 3000);
}else if(failedPhp){
    setTimeout(() => {
        failedPhp.classList.add('hidden');
    }, 3000);
}