const waktu = document.getElementById('waktu');
let waktuBaru = '10:01';

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

setTimeout(() => {
    document.getElementById('kirim-ulang').classList.toggle('hidden');
}, 1000 * 5);

const form = document.getElementsByTagName('form')[0];
const notif =  document.getElementById('failed');
const success =  document.getElementById('success');

form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const formData = new FormData(form);
    const response = await fetch('/verifikasi', {
        method: "POST",
        body: formData
    });
    
    if(response.ok){
        const data = await response.json();
        
        if('success' in data){
            localStorage.setItem('successMessage', data.success);

            document.location.href = 'login';
        }else if('failed' in data){
            notif.classList.remove('hidden');
            notif.innerHTML = data.failed
            form.reset();
            success.classList.add('hidden');
        }
    }else{
        console.error('Gagal melakukan permintaan:', response.status);
    }
});