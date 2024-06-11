const waktu = document.getElementById('waktu');
const kirimUlangTag = document.getElementById('kirim-ulang');
const kirimUlangTag2 = document.getElementById('kirim-ulang-2');
let waktuBaru = '10:00';
let statusKirimUlangKodeOtp = false;

function stopwatch(){
    let timeArray = waktuBaru.split(':');
    let minutes = parseInt(timeArray[0]);
    let seconds = parseInt(timeArray[1]);

    if (minutes === 0 && seconds === 0) {
        clearInterval(interval);
        statusKirimUlangKodeOtp = true;
        return;
    }

    if (seconds === 0) {
        minutes--;
        seconds = 59;
    } else {
        seconds--;
    }

    // Mengonversi angka menjadi string dan menambahkan leading zero jika diperlukan
    let minutesString = minutes.toString().padStart(2, '0');
    let secondsString = seconds.toString().padStart(2, '0');

    waktuBaru = minutesString + ':' + secondsString;
    waktu.innerHTML = waktuBaru;
}

// Memanggil stopwatch setiap detik
let interval = setInterval(stopwatch, 1000);

const waktu2 = document.getElementById('waktu-2');
let waktuBaru2 = '00:30';

function stopwatch2(){
    let timeArray = waktuBaru2.split(':');
    let minutes = parseInt(timeArray[0]);
    let seconds = parseInt(timeArray[1]);

    if (minutes === 0 && seconds === 0) {
        clearInterval(interval2);
        kirimUlangTag.classList.remove('hidden');
        kirimUlangTag2.classList.add('hidden');
        return;
    }

    if (seconds === 0) {
        minutes--;
        seconds = 59;
    } else {
        seconds--;
    }

    // Mengonversi angka menjadi string dan menambahkan leading zero jika diperlukan
    let minutesString = minutes.toString().padStart(2, '0');
    let secondsString = seconds.toString().padStart(2, '0');

    waktuBaru2 = minutesString + ':' + secondsString;
    waktu2.innerHTML = waktuBaru2;
}

// Memanggil stopwatch setiap detik
let interval2 = setInterval(stopwatch2, 1000);

const form = document.getElementById('form');
const notif =  document.getElementById('failed');
const success =  document.getElementById('success');
const success2 =  document.getElementById('success-2');
const errorMessage = document.getElementById('error-message');

async function kirim(url){
    const formData = new FormData(form);
    const response = await fetch(url, {
        method: "POST",
        body: formData
    });

    try {
        const data = await response.json();
        
        if('success' in data){
            if(url == 'http://127.0.0.1:8000/verifikasi'){
                localStorage.setItem('successMessage', data.success);
                document.location.href = 'login';
            }else if(url == 'http://127.0.0.1:8000/verifikasi-otp-reset-password'){
                localStorage.setItem('successMessage', data.success);
                document.location.href = 'reset-password';
            }else if(url == 'http://127.0.0.1:8000/pasien-verifikasi'){
                localStorage.setItem('successMessage', data.success);
                document.location.href = 'profil';
            }
        }else if('failed' in data){
            notif.classList.remove('hidden');
            notif.innerHTML = data.failed;
            errorMessage.classList.add('hidden');
            success2.classList.add('hidden');
            form.reset();

            if(success != null){ // kalo ada
                success.classList.add('hidden');
            }

            window.scrollTo({top: 0, behavior: 'smooth'});
        }else{
            if('kode_verifikasi' in data.errors){
                errorMessage.classList.remove('hidden');
                errorMessage.innerHTML = data.errors.kode_verifikasi;
                notif.classList.add('hidden');
                success2.classList.add('hidden');
                form.reset();

                if(success != null){ // kalo ada
                    success.classList.add('hidden');
                }
            }
        }
    }catch(error){
        console.error(error)
    }
};

const kirimUlang =  async (csrf, url) => {
    const form = document.createElement('form');
    const input = document.createElement('input');
    input.setAttribute('name', '_token');
    input.value = csrf;
    form.appendChild(input);

    const formData = new FormData(form);
    const response = await fetch(url, {
        method: "POST",
        body: formData
    });

    try {
        const data = await response.json();

        if(statusKirimUlangKodeOtp){
            waktuBaru = '10:00';
            waktu.innerHTML = '10:00';
            interval = setInterval(stopwatch, 1000);
            statusKirimUlangKodeOtp = false;
        }
        
        waktuBaru2 = '00:30';
        waktu2.innerHTML = '00:30';
        kirimUlangTag.classList.add('hidden');
        kirimUlangTag2.classList.remove('hidden');
        interval2 = setInterval(stopwatch2, 1000);

        success2.classList.add('hidden');
        window.scrollTo({top: 0, behavior: 'smooth'});
        setTimeout(() => {
            success2.classList.remove('hidden');
            success2.innerHTML = data.success;
            errorMessage.classList.add('hidden');
            notif.classList.add('hidden');

            if(success != null){ // kalo ada
                success.classList.add('hidden');
            }
        }, 100);
    }catch(error){
        console.error(error);
    }
};

const batal =  async (csrf) => {
    const form = document.createElement('form');
    const inputCsrf = document.createElement('input');
    inputCsrf.setAttribute('name', '_token');
    inputCsrf.value = csrf;
    form.appendChild(inputCsrf);

    const formData = new FormData(form);
    const response = await fetch('/cancel-ubah-profil', {
        method: "POST",
        body: formData
    });

    try {
        const data = await response.json();

        if('failed' in data){
            localStorage.setItem('failedMessage', data.failed);

            document.location.href = '/profil';
        }
    }catch(error){
        console.error(error);
    }
};