<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RawatInap;
use App\Models\Reservasi;
use App\Models\RekamMedis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\ResponseSequence;
use Twilio\Rest\Serverless\V1\Service\FunctionInstance;

class PasienController extends Controller {
    public function showDashboardPasien(){
        return view('dashboard');
    }
    
    public function editProfil(){
        return view('profil');
    }
    
    public function updateProfil(Request $request){
        $user = User::find(auth()->user()->id);

        if( // tidak ada yang berubah
            $request->nama == $user->pasien->nama &&
            $request->nomor_handphone == $user->nomor_handphone &&
            $request->alamat == $user->pasien->alamat &&
            $request->pekerjaan == $user->pasien->pekerjaan
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }else if( // cuma nomor handphone yang tidak berubah
            $request->nomor_handphone == $user->nomor_handphone && (
            $request->nama != $user->pasien->nama ||
            $request->alamat != $user->pasien->alamat ||
            $request->pekerjaan != $user->pasien->pekerjaan)
        ){
            $messages = [
                'nama.required' => 'Kolom nama harus diisi.',
                'nama.max' => 'Maksimal 255 karakter.',
                'alamat.required' => 'Kolom alamat harus diisi.',
                'alamat.max' => 'Maksimal 255 karakter.',
                'pekerjaan.required' => 'Kolom pekerjaan harus diisi.',
                'pekerjaan.max' => 'Maksimal 255 karakter.',
            ];
    
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'pekerjaan' => ['required', 'string', 'max:255'],
            ], $messages);

            Pasien::where('id_user', $user->id)->update($validated);

            $reservasi = Reservasi::where('nomor_handphone', $user->nomor_handphone)->get();
            if($reservasi){
                Reservasi::where('nomor_handphone', $user->nomor_handphone)->update([
                    'nama_pasien' => $request->nama,
                    'alamat' => $request->alamat,
                ]);
            }
            
            $rekamMedis = RekamMedis::where('nomor_handphone', $user->nomor_handphone)->get();
            if($rekamMedis){
                RekamMedis::where('nomor_handphone', $user->nomor_handphone)->update([
                    'nama_pasien' => $request->nama,
                    'pekerjaan' => $request->pekerjaan,
                    'alamat' => $request->alamat,
                ]);
            }
            
            $rawatInap = RawatInap::where('nomor_handphone', $user->nomor_handphone)->get();
            if($rawatInap){
                RawatInap::where('nomor_handphone', $user->nomor_handphone)->update([
                    'nama_pasien' => $request->nama,
                    'alamat' => $request->alamat,
                ]);
            }
        }else{ // nomor handphone dan yang lain berubah
            $messages = [
                'nama.required' => 'Kolom nama harus diisi.',
                'nama.max' => 'Maksimal 255 karakter.',
                'alamat.required' => 'Kolom alamat harus diisi.',
                'alamat.max' => 'Maksimal 255 karakter.',
                'pekerjaan.required' => 'Kolom pekerjaan harus diisi.',
                'pekerjaan.max' => 'Maksimal 255 karakter.',
                'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
                'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
                'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
                'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
                'nomor_handphone.regex' => 'Nomor handphone tidak valid',
                'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
            ];
    
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'pekerjaan' => ['required', 'string', 'max:255'],
                'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'],
            ], $messages);

            if(substr(trim($request->nomor_handphone), 0, 1) == '0'){
                $nomorHP = '+62'.substr(trim($request->nomor_handphone), 1);
            }
    
            /* try {
                $token = getenv("TWILIO_AUTH_TOKEN");
                $twilioSid = getenv("TWILIO_SID");
                $twilioVerifySid = getenv("TWILIO_VERIFY_SID");
                
                $twilio = new Client($twilioSid, $token);
                $twilio->verify->v2->services($twilioVerifySid)
                    ->verifications
                    ->create($nomorHP, "sms");
            }catch(\Throwable $th){
                return back()->withInput()->with('failed', 'Registrasi gagal, tidak dapat mengirim kode OTP');
            } */

            $request = $request->all();
            $request['nomor_handphone_lama'] = $user->nomor_handphone;
            $request['nomor_handphone_dimodifikasi'] = $nomorHP;

            session()->put('request', $request);

            return redirect(route('pasien.verifikasi'))->with('success', 'Berhasil, Kode OTP sudah dikirim ke nomor handphone anda');
        }

        return back()->with('success', 'Profil berhasil diubah');
    }

    public function createVerifikasi(){
        if(session()->get('request') == null){
            return redirect(route('pasien.profil'));
        }

        return view('pasien-verifikasi');
    }

    public function storeVerifikasi(Request $request){
        $messages = [
            'kode_verifikasi.required' => 'Silahkan masukkan kode OTP.',
            'kode_verifikasi.numeric' => 'Kode OTP yang dimasukkan harus berupa angka.',
            'kode_verifikasi.digits' => 'Kode OTP harus terdiri dari :digits digit.',
            'nomor_handphone.required' => 'Silahkan masukkan nomor handphone.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
        ];

        $validator = Validator::make($request->all(), [
            'kode_verifikasi' => ['required', 'numeric', 'digits:6'],
            'nomor_handphone' => ['required', 'string'],
        ], $messages);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        if($request->kode_verifikasi != '123456'){
            // return back()->with('failed', 'Kode OTP salah!');
            return response()->json(['failed' => 'Kode OTP Salah']);
        }

        /* try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioSid = getenv("TWILIO_SID");
            $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

            $twilio = new Client($twilioSid, $token);
            $verification = $twilio->verify->v2->services($twilioVerifySid)
                ->verificationChecks
                ->create(['code' => $request->kode_verifikasi, 'to' => $request->nomor_handphone]);
        }catch(\Throwable $th){
            return back()->with('failed', 'Durasi kode OTP sudah habis!');
        } */

        $request = session()->get('request');

        // if($verification->valid){
            User::find(auth()->user()->id)->update([
                'nomor_handphone' => $request['nomor_handphone']
            ]);

            Pasien::where('id_user', auth()->user()->id)->update([
                'nama' => $request['nama'],
                'alamat' => $request['alamat'],
                'pekerjaan' => $request['pekerjaan'],
            ]);

            $reservasi = Reservasi::where('nomor_handphone', $request['nomor_handphone_lama'])->get();
            if($reservasi){
                Reservasi::where('nomor_handphone', $request['nomor_handphone_lama'])->update([
                    'nama_pasien' => $request['nama'],
                    'alamat' => $request['alamat'],
                    'nomor_handphone' => $request['nomor_handphone']
                ]);
            }
            
            $rekamMedis = RekamMedis::where('nomor_handphone', $request['nomor_handphone_lama'])->get();
            if($rekamMedis){
                RekamMedis::where('nomor_handphone', $request['nomor_handphone_lama'])->update([
                    'nama_pasien' => $request['nama'],
                    'pekerjaan' => $request['pekerjaan'],
                    'alamat' => $request['alamat'],
                    'nomor_handphone' => $request['nomor_handphone']
                ]);
            }
            
            $rawatInap = RawatInap::where('nomor_handphone', $request['nomor_handphone_lama'])->get();
            if($rawatInap){
                RawatInap::where('nomor_handphone', $request['nomor_handphone_lama'])->update([
                    'nama_pasien' => $request['nama'],
                    'alamat' => $request['alamat'],
                    'nomor_handphone' => $request['nomor_handphone']
                ]);
            }
            
            session()->forget('request');
    
            // return redirect(route('login'))->with('success', 'Akun berhasil dibuat, silahkan login');
            return response()->json(['success' => 'Profil berhasil diubah']);
        /* }else{
            return back()->with('failed', 'Kode OTP salah!');
        } */
    }

    public function storeKirimUlangKodeOtp(){
        /* try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioSid = getenv("TWILIO_SID");
            $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

            $twilio = new Client($twilioSid, $token);
            $twilio->verify->v2->services($twilioVerifySid)
                ->verifications
                ->create(session()->get('request')['nomor_handphone_dimodifikasi'], "sms");
        }catch(\Throwable $th){
            return back()->with('failed', 'Registrasi gagal, tidak dapat mengirim kode OTP');
        } */

        // return back()->with('success', 'Berhasil, Kode OTP sudah dikirim ulang ke nomor handphone anda, silahkan masukkan kode OTP yang diterima');
        return response()->json(['success' => 'Berhasil, Kode OTP sudah dikirim ulang ke nomor handphone anda']);
    }

    public function updateFotoProfil(Request $request){
        $messages = [
            'foto.required' => 'Silahkan pilih foto terlebih dahulu.',
            'foto.image' => 'File yang boleh dimasukkan berupa foto.',
            'foto.mimes' => 'Format foto yang diperbolehkan adalah: jpeg, png, jpg.',
            'foto.max' => 'Ukuran maksimal foto yang diunggah adalah 2 MB.',
        ];

        $validator = Validator::make($request->all(), [
            'foto' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
        ], $messages);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        $foto = $request->file('foto');

        $ekstensiFoto = $foto->extension();
        $namaFoto = Str::random(40);
        $namaFoto = $namaFoto . '.' . $ekstensiFoto;
        $namaFoto2 = 'img/' . $namaFoto;

        if($request->jenis == 'ubah'){
            Storage::delete(auth()->user()->foto);
        }
        $foto->move(storage_path('app\\public\\img'), $namaFoto);

        User::find(auth()->user()->id)->update([
            'foto' => $namaFoto2
        ]);

        return response()->json([
            'success' => 'Foto profil berhasil diubah'
        ]);
    }

    public function destroyFotoProfil(){
        Storage::delete(auth()->user()->foto);

        User::find(auth()->user()->id)->update([
            'foto' => null
        ]);

        return response()->json([
            'success' => 'Foto profil berhasil dihapus'
        ]);
    }

    public function editPassword(){
        return view('edit-password');
    }
    
    public function updatePassword(Request $request){
        $messages = [
            'password.required' => 'Kolom password harus diisi.',
            'password.same' => 'Password dan konfirmasi password harus sama.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.max' => 'Password tidak boleh melebihi :max karakter.',
            'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
            'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
            'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
            'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.',
            'old_password.required' => 'Kolom password lama harus diisi.',
            'old_password.min' => 'Password lama harus terdiri dari minimal :min karakter.',
            'old_password.max' => 'Password lama tidak boleh melebihi :max karakter.'
        ];

        $request->validate([
            'old_password' => ['required', 'min:8', 'max:255'],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255']
        ], $messages);

        $user = User::find(auth()->user()->id);
        if(Hash::check($request->old_password, $user->password)){
            if($request->password == $request->old_password){
                return back()->with('failed', 'Gagal update password, tidak ada perubahan pada password');
            }

            User::where('id', auth()->user()->id)->update([
                'password' => bcrypt($request->password)
            ]);

            return back()->with('success', 'Password berhasil diubah');
        }

        return back()->with('failed', 'Gagal update password, password lama salah');
    }

    public function destroyAkun(){
        if(auth()->user()->foto){
            Storage::delete(auth()->user()->foto);
        }

        User::find(auth()->user()->id)->delete();

        return redirect('/');
    }

    public function cancelUbahProfil(){
        session()->forget('request');

        return response()->json(['failed' => 'Gagal ubah profil']);
    }
    
    public function indexReservasi(){
        $reservasis = DB::table('view_reservasi')
            ->where('nomor_handphone', auth()->user()->nomor_handphone)
            ->latest()
            ->get();

        $idUserDokter = Dokter::pluck('id_user');

        $users = User::whereIn('id', $idUserDokter)->get();
        
        $docterPhotos = [];

        foreach ($users as $key) {
            $docterPhotos[] = [
                'nama_dokter' => $key->dokter->nama,
                'foto' => $key->foto,
            ];
        }

        return view('reservasi', compact('reservasis', 'docterPhotos'));
    }

    public function createReservasi(){
        $spesialis = Dokter::select('spesialis')
            ->groupBy('spesialis')
            ->get();

        $tanggal = request()->query('tanggal');
        $spesialisQuery = request()->query('spesialis');
        $nama = request()->query('nama');
        $waktu = request()->query('waktu');

        if(($tanggal && $spesialisQuery && $nama && $waktu) || (!$tanggal && !$spesialisQuery && !$nama && !$waktu)){
            return view('buat-reservasi', compact('spesialis', 'tanggal', 'spesialisQuery', 'nama', 'waktu'));
        }else{
            return redirect()->route('reservasi');
        }
    }

    public function storeDaftarDokter(Request $request){
        $dokters = DB::table('view_jadwal_dokter')
            ->where('hari', $request->hari)
            ->where('spesialis', $request->spesialis)
            ->orderBy('jam')
            ->orderBy('nama')
            ->get();

        return response()->json(['dokters' => $dokters]);
    }

    public function storeReservasi(Request $request){
        $messages = [
            'tanggal.required' => 'Silahkan pilih tanggal.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'spesialis.required' => 'Silahkan pilih spesialis dari dokter yang akan dipilih.',
            'dokter.required' => 'Silahkan pilih dokter.',
        ];

        $request->validate([
            'tanggal' => ['required', 'date'],
            'spesialis' => ['required', 'string'],
            'dokter' => ['required', 'string'],
        ], $messages);

        $auth = auth()->user();
        $umur = Carbon::parse($auth->pasien->tanggal_lahir)->age;
        $dataDokter = explode('|', $request->dokter);

        // ini untuk membuat waktu rekomendasi untuk antrian
        $cekAntrian = Reservasi::select('id')
            ->where('nama_dokter', $dataDokter[0])
            ->where('tanggal', $request->tanggal)
            ->where(function($query){
                $query->where('status', 'Menunggu')
                      ->orWhere('status', 'Selesai');
            })
            ->get();

        $waktuAwal = explode('-', $dataDokter[1]);
        $waktuAwal = $waktuAwal[0];
        $waktuAwal = Carbon::createFromFormat('H:i', $waktuAwal);
        $waktuRekomendasiCarbon = $waktuAwal->addMinutes(count($cekAntrian) * 20);
        $waktuRekomendasi = $waktuRekomendasiCarbon->format('H:i');

        $today = Carbon::today();
        $currentTime = Carbon::now();
        $carbonDateToCheck = Carbon::parse($request->tanggal);
        $isDateGreaterThanToday = $carbonDateToCheck->gt($today);

        if(!$isDateGreaterThanToday){ // berarti hari ini
            $waktuAkhir = explode('-', $dataDokter[1]);
            $waktuAkhir = $waktuAkhir[1];
            
            $waktuAkhirCarbon = Carbon::createFromFormat('H:i', $waktuAkhir);
            $waktuAkhirCarbonKurang1Jam = $waktuAkhirCarbon->subHour();
            $isCurrentTimeLess = $currentTime->lt($waktuAkhirCarbonKurang1Jam);

            // cek apakah waktu rekomendasi lebih besar dari waktu akhir jadwal dokter
            $waktuAkhirCarbon = Carbon::createFromFormat('H:i', $waktuAkhir);
            $waktuAkhirCarbonKurang20Menit = $waktuAkhirCarbon->subMinutes(20);
            $apakahWaktuRekomendasiLebihDari = $waktuRekomendasiCarbon->gt($waktuAkhirCarbonKurang20Menit);
            
            if($isCurrentTimeLess){ // waktu lebih kecil dari 1 jam sebelum
                if($apakahWaktuRekomendasiLebihDari){
                    return back()->with('failed', 'Antrian sudah penuh, silahkan pilih hari berikutnya');
                }
                Reservasi::create([
                    'nama_pasien' => $auth->pasien->nama,
                    'umur' => $umur,
                    'alamat' => $auth->pasien->alamat,
                    'nomor_handphone' => $auth->nomor_handphone,
                    'nama_dokter' => $dataDokter[0],
                    'spesialis' => $request->spesialis,
                    'status' => 'Menunggu',
                    'jenis_kelamin' => $auth->pasien->jenis_kelamin,
                    'tanggal' => $request->tanggal,
                    'jam' => $dataDokter[1],
                    'created_at' => $currentTime,
                    'updated_at' => $currentTime,
                ]);
            }else{
                return back()->with('failed', 'Waktu reservasi dokter ini sudah habis, disarankan daftar 1 jam sebelum waktu dokter berakhir');
            }
        }else{ // masa depan
            Reservasi::create([
                'nama_pasien' => $auth->pasien->nama,
                'umur' => $umur,
                'alamat' => $auth->pasien->alamat,
                'nomor_handphone' => $auth->nomor_handphone,
                'nama_dokter' => $dataDokter[0],
                'spesialis' => $request->spesialis,
                'status' => 'Menunggu',
                'jenis_kelamin' => $auth->pasien->jenis_kelamin,
                'tanggal' => $request->tanggal,
                'jam' => $dataDokter[1],
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
        }

        return back()->with('success', 'Reservasi berhasil, datanglah jam ' . $waktuRekomendasi);
    }

    public function indexDokter(){
        $dokters = DB::table('view_jadwal_dokter')
            ->select('id_dokter', 'foto', 'nama', 'spesialis')
            ->orderBy('nama')
            ->orderBy('hari')
            ->orderBy('jam')
            ->groupBy('id_dokter', 'foto', 'nama', 'spesialis')
            ->get();
        
        $jadwals = DB::table('view_jadwal_dokter')
            ->select('id_dokter', 'hari', 'jam')
            ->orderBy('hari')
            ->orderBy('jam')
            ->get();

        return view('dokter', compact('dokters', 'jadwals'));
    }

    public function destroyReservasi(Request $request){
        $reservasi = Reservasi::where('id', $request->id)
            ->where('nomor_handphone', auth()->user()->nomor_handphone)
            ->get();

        if($reservasi->isEmpty()){
            abort(404);
        }else{
            $reservasi[0]->update([
                'status' => 'Batal'
            ]);
        }

        return back();
    }
}