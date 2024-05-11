const waktu = document.getElementById('waktu');
let waktuBaru = '10:00';

function stopwatch() {
    let timeArray = waktuBaru.split(':');
    let minutes = parseInt(timeArray[0]);
    let seconds = parseInt(timeArray[1]);

    if (minutes === 0 && seconds === 0) {
        clearInterval(interval);
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

function stopwatch2() {
    let timeArray = waktuBaru2.split(':');
    let minutes = parseInt(timeArray[0]);
    let seconds = parseInt(timeArray[1]);

    if (minutes === 0 && seconds === 0) {
        clearInterval(interval2);
        document.getElementById('kirim-ulang').classList.remove('hidden');
        document.getElementById('kirim-ulang-2').classList.add('hidden');
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

const form = document.getElementsByTagName('form')[0];
const notif =  document.getElementById('failed');
const success =  document.getElementById('success');
const errorMessage = document.getElementById('error-message');

const kirim =  async (url) => {
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
            }else{
                localStorage.setItem('successMessage', data.success);
                document.location.href = 'reset-password';
            }
        }else if('failed' in data){
            errorMessage.classList.add('hidden');
            notif.classList.remove('hidden');
            notif.innerHTML = data.failed
            form.reset();

            if(success != null){ // kalo ada
                success.classList.add('hidden');
            }
        }else{
            if('kode_verifikasi' in data.errors){
                errorMessage.classList.remove('hidden');
                notif.classList.add('hidden');
                errorMessage.innerHTML = data.errors.kode_verifikasi;
                form.reset();

                if(success != null){ // kalo ada
                    success.classList.add('hidden');
                }
            }
        }
    }catch(error){
        console.log(error)
    }
};