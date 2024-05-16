<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            $request['nomor_handphone_dimodifikasi'] = $nomorHP;

            session()->put('request', $request);

            return redirect(route('pasien.verifikasi'))->with('success', 'Berhasil, Kode OTP sudah dikirim ke nomor handphone anda, silahkan masukkan kode OTP yang diterima');
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
        return response()->json(['success' => 'Berhasil, Kode OTP sudah dikirim ulang ke nomor handphone anda, silahkan masukkan kode OTP yang diterima']);
    }

    public function updateFotoProfil(Request $request){
        $messages = [
            'foto.required' => 'Silahkan pilih foto terlebih dahulu.',
            'foto.image' => 'File yang boleh dimasukkan berupa foto.',
            'foto.mimes' => 'Format foto yang diperbolehkan adalah: jpeg, png, jpg.',
            'foto.max' => 'Ukuran maksimal foto yang diunggah adalah 2MB.',
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

    public function hapusFotoProfil(){
        Storage::delete(auth()->user()->foto);       

        User::find(auth()->user()->id)->update([
            'foto' => null
        ]);

        return response()->json([
            'success' => 'Foto profil berhasil dihapus'
        ]);
    }
}