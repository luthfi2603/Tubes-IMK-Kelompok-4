<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik RH61</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}">
</head>
<body>
    <div class="flex flex-col items-center">
        @if(session()->has('failed'))
            <div class="mt-4 bg-red-300 py-3 text-white px-9 rounded-lg">
                {{ session('failed') }}
            </div>
        @elseif(session()->has('success'))
            <div class="mt-4 bg-green-300 py-3 text-white px-9 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        <p class="my-4 font-semibold text-xl">Verifikasi</p>
        {{-- @if(session()->all()['_previous']['url'] == 'http://127.0.0.1:8000/register') --}}
        <form method="POST" action="{{ route('verifikasi') }}" class="w-9/12 md:w-1/4 flex flex-col items-center">
            @csrf
            <input type="hidden" name="nomor_handphone" value="{{ session()->get('request')['nomor_handphone_dimodifikasi'] }}">
            <div class="flex flex-col mb-3 w-full">
                <label for="kode_verifikasi">Kode OTP</label>
                <input type="number" name="kode_verifikasi" id="kode_verifikasi" class="@error('kode_verifikasi') bg-red-500 placeholder-white @enderror" placeholder="Masukkan kode OTP" autofocus>
                @error('kode_verifikasi')
                    <div class="bg-red-300 text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <p>Masukkan kode OTP dalam waktu 10 menit</p>
            {{-- <div>Waktu tersisa <span id="waktu" class="font-bold"></span></div> --}}
            <a id="kirim-ulang" href="{{ route('kirim.ulang.kode.otp') }}" class="font-bold underline text-blue-500">Kirim Ulang</a>
            <button type="submit" class="px-4 py-2 bg-gray-400 rounded-xl text-white mb-4 mt-3">Kirim</button>
        </form>
    </div>
    <script>
        /* const waktu = document.getElementById('waktu');
        let waktuBaru = '00:06';

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
        }, 1000 * 6); */

        /* const form = document.getElementsByTagName('form')[0];

        const submit = async (data) => {
            try {
                await fetch("{{ route('verifikasi') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: data
                });
            } catch (error) {
                console.error(error);
            }
        }

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            let params = new URLSearchParams();

            // Menambahkan pasangan kunci-nilai
            params.append('_token', form.elements['_token'].value);
            params.append('kode_verifikasi', form.elements['kode_verifikasi'].value);
            params.append('nomor_handphone', form.elements['nomor_handphone'].value);

            // Mendapatkan string query
            let queryString = params.toString();

            console.log(queryString);

            submit(queryString);
        }); */
    </script>
</body>
</html>