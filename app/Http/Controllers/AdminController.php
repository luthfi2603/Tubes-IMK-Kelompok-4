<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Waktu;
use App\Models\Dokter;
use App\Models\Pasien;
// use App\Models\RawatInap;
use App\Models\Perawat;
use App\Models\Reservasi;
use App\Models\RekamMedis;
use Illuminate\Support\Str;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
    public function showDashboardAdmin(){
        $dokters = DB::table('view_data_dokter')
            ->limit(4)
            ->get();

        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        $antrians = DB::table('view_reservasi')
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->where('tanggal', $tanggalHariIni)
            ->limit(4)
            ->get();

        $jumlahPasien = Pasien::count();

        $pasiens = DB::table('view_data_pasien')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('admin.dashboard', compact('dokters', 'antrians', 'jumlahPasien', 'pasiens'));
    }

    public function indexPasien(){
        $users = User::whereHas('pasien')
            ->with('pasien')
            ->orderBy(Pasien::select('nama')->whereColumn('pasiens.id_user', 'users.id'), 'asc')
            ->paginate(10);
            
        return view('admin.pasien-index', compact('users'));
    }

    public function storeCariPasien(Request $request){
        $kataKunci = $request->kataKunci;

        $pasiens = DB::table('view_data_pasien')
            ->where(function ($query) use ($kataKunci) {
                $query->where('nama', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('nomor_handphone', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('alamat', 'LIKE', '%' . $kataKunci . '%');
            })
            ->orderBy('nama')
            ->get();

        return response()->json(['pasiens' => $pasiens]);
    }

    public function createPasienReservasi($nomorHandphone){
        $user = User::where('nomor_handphone', $nomorHandphone)->first();

        if(!$user){
            return back();
        }

        $spesialis = Dokter::select('spesialis')
            ->groupBy('spesialis')
            ->get();

        return view('admin.pasien-reservasi', compact('spesialis'));
    }

    public function storePasienReservasi(Request $request, $nomorHandphone){
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

        $auth = User::where('nomor_handphone', $nomorHandphone)->first();
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
                    'foto' => $auth->foto,
                    'created_at' => $currentTime,
                    'updated_at' => $currentTime,
                ]);

                return back()->with('success', 'Reservasi berhasil, datanglah sesuai jadwal dokter yang anda pilih');
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
                'foto' => $auth->foto,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);

            return back()->with('success', 'Reservasi berhasil, datanglah pada hari ' . $carbonDateToCheck->translatedFormat('l, d F Y') . ' jam '. $waktuRekomendasi);
        }
    }

    /* public function dataKaryawan(){
        $karyawan = DB::table('data_karyawan')
            ->paginate(5);
            
        return view('admin.data-karyawan', compact('karyawan'));
    } */

    public function editPasien($nohp){
        $pasien = Pasien::join('users', 'pasiens.id_user', '=', 'users.id')
            ->select('users.nomor_handphone', 'pasiens.nama', 'users.id', 'pasiens.alamat', 'pasiens.pekerjaan', 'pasiens.jenis_kelamin', 'pasiens.tanggal_lahir')
            ->where('users.nomor_handphone', $nohp)
            ->get();

        if($pasien->isEmpty()){
            return back();
        }

        $pasien = $pasien[0];

        return view('admin.pasien-edit', compact('pasien'));
    }

    public function updatePasien(Request $request, $id){
        $user = User::find($id);

        if(
            $request->nama == $user->pasien->nama &&
            $request->nomor_handphone == $user->nomor_handphone &&
            $request->alamat == $user->pasien->alamat &&
            $request->pekerjaan == $user->pasien->pekerjaan &&
            $request->jenis_kelamin == $user->pasien->jenis_kelamin &&
            $request->tanggal_lahir == $user->pasien->tanggal_lahir
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
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
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
                'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            ];

            $rules = [
                'nama' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'pekerjaan' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'jenis_kelamin' => ['required', 'in:P,L'],
            ];

            if($request->nomor_handphone != $user->nomor_handphone){
                $rules['nomor_handphone'] = ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'];
            }

            $request->validate($rules, $messages);

            $umur = Carbon::parse($request->tanggal_lahir)->age;

            if($umur > 255){
                return back()->withInput()->with('failed', 'Tanggal lahir tidak valid');
            }

            Pasien::where('id_user', $user->id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            Reservasi::where('nomor_handphone', $user->nomor_handphone)->update([
                'nama_pasien' => $request->nama,
                'umur' => $umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'nomor_handphone' => $request->nomor_handphone,
            ]);
            
            RekamMedis::where('nomor_handphone', $user->nomor_handphone)->update([
                'nama_pasien' => $request->nama,
                'umur' => $umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'nomor_handphone' => $request->nomor_handphone,
            ]);

            $user->update([
                'nomor_handphone' => $request->nomor_handphone
            ]);
            
            return redirect()->route('admin.edit.pasien', $request->nomor_handphone)->with('success', 'Data pasien berhasil diubah');
        }
    }

    public function banPasien($nomor_handphone){
        $pasien = User::where('nomor_handphone', $nomor_handphone)->first();
        if ($pasien) {
            $pasien->aktif = 0; // Update aktif to banned
            $pasien->save();
        }
        return redirect()->route('admin.data.pasien')->with('success', 'Pasien berhasil diblokir');
    }

    public function unbanPasien($nomor_handphone){
        $pasien = User::where('nomor_handphone', $nomor_handphone)->first();
        if ($pasien) {
            $pasien->aktif = 1; // Update status to unbanned
            $pasien->save();
        }
        return redirect()->route('admin.data.pasien')->with('success', 'Pasien berhasil diaktifkan kembali');
    }

    public function createPasien(){
        $nomorHandphone = request()->query('nomor_handphone');

        return view('admin.pasien-input', compact('nomorHandphone'));
    }

    public function storePasien(Request $request){
        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
            'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
            'tanggal_lahir.required' => 'Kolom tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'pekerjaan.required' => 'Kolom pekerjaan harus diisi.',
            'pekerjaan.regex' => 'Hanya boleh huruf kapital, huruf kecil, dan spasi.',
            'pekerjaan.max' => 'Maksimal 255 karakter.',
        ];

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:P,L'],
            'tanggal_lahir' => ['required', 'date'],
            'pekerjaan' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
        ], $messages);

        $umur = Carbon::parse($request->tanggal_lahir)->age;

        if($umur > 255){
            return back()->withInput()->with('failed', 'Tanggal lahir tidak valid');
        }

        if(substr(trim($request->nomor_handphone), 0, 1) == '0'){
            $nomorHP = '+62'.substr(trim($request->nomor_handphone), 1);
        }

        User::create([
            'nomor_handphone' => $request->nomor_handphone,
            'status' => 'Pasien',
        ]);

        Pasien::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'id_user' => User::latest()->first()->id
        ]);

        return back()->with('success', 'Data pasien berhasil ditambahkan!');
    }

    public function indexPerawat(){
        $perawats = DB::table('view_data_perawat')->paginate(10);
        
        return view('admin.perawat-index', compact('perawats'));
    }
    
    public function createPerawat(){
        return view('admin.perawat-input');
    }
    
    public function storePerawat(Request $request){
        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nama.max' => 'Kolom nama tidak boleh melebihi :max karakter.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
            'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'alamat.max' => 'Kolom alamat tidak boleh melebihi :max karakter.',
            'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
            'password.required' => 'Kolom password harus diisi.',
            'password.same' => 'Password dan konfirmasi password harus sama.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.max' => 'Password tidak boleh melebihi :max karakter.',
            'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
            'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
            'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
            'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.',
            'foto.image' => 'File yang boleh dimasukkan berupa foto.',
            'foto.mimes' => 'Format foto yang diperbolehkan adalah: jpeg, png, jpg.',
            'foto.max' => 'Ukuran maksimal foto yang diunggah adalah 2 MB.',
        ];

        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:P,L'],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255'],
        ];

        if($request->hasFile('foto')){
            $rules['foto'] = ['image', 'mimes:jpeg,png,jpg', 'max:2048'];
        }

        $request->validate($rules, $messages);

        $namaFoto2 = null;

        if($request->hasFile('foto')){
            $foto = $request->file('foto');

            $ekstensiFoto = $foto->extension();
            $namaFoto = Str::random(40);
            $namaFoto = $namaFoto . '.' . $ekstensiFoto;
            $namaFoto2 = 'img/' . $namaFoto;

            $foto->move(storage_path('app\\public\\img'), $namaFoto);
        }

        User::create([
            'nomor_handphone' => $request->nomor_handphone,
            'password' => bcrypt($request->password),
            'status' => 'Perawat',
            'foto' => $namaFoto2,
            'aktif' => 1
        ]);

        Perawat::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => User::latest()->first()->id
        ]);

        return back()->with('success', 'Perawat berhasil ditambah');
    }

    public function editPerawat($nomorHandphone){
        $perawat = DB::table('view_data_perawat')
            ->where('nomor_handphone', $nomorHandphone)
            ->get();

        if($perawat->isEmpty()){
            return back();
        }

        $perawat = $perawat[0];

        return view('admin.perawat-edit', compact('perawat'));
    }

    public function updatePerawat(Request $request, $id){
        $user = User::find($id);

        if(
            $request->nama == $user->perawat->nama &&
            $request->nomor_handphone == $user->nomor_handphone &&
            $request->alamat == $user->perawat->alamat &&
            $request->jenis_kelamin == $user->perawat->jenis_kelamin &&
            !$request->hasFile('foto') &&
            !$request->password &&
            !$request->konfirmasi_password &&
            !$request->hapus
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }else{
            $messages = [
                'nama.required' => 'Kolom nama harus diisi.',
                'nama.max' => 'Kolom nama tidak boleh melebihi :max karakter.',
                'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
                'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
                'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
                'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
                'nomor_handphone.regex' => 'Nomor handphone tidak valid',
                'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
                'alamat.required' => 'Kolom alamat harus diisi.',
                'alamat.max' => 'Kolom alamat tidak boleh melebihi :max karakter.',
                'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
                'foto.image' => 'File yang boleh dimasukkan berupa foto.',
                'foto.mimes' => 'Format foto yang diperbolehkan adalah: jpeg, png, jpg.',
                'foto.max' => 'Ukuran maksimal foto yang diunggah adalah 2 MB.',
                'password.required' => 'Kolom password harus diisi.',
                'password.same' => 'Password dan konfirmasi password harus sama.',
                'password.min' => 'Password harus terdiri dari minimal :min karakter.',
                'password.max' => 'Password tidak boleh melebihi :max karakter.',
                'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
                'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
                'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
                'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.',
            ];

            $rules = [
                'nama' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'jenis_kelamin' => ['required', 'in:P,L'],
            ];

            if($request->nomor_handphone != $user->nomor_handphone){
                $rules['nomor_handphone'] = ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'];
            }

            if($request->hasFile('foto')){
                $rules['foto'] = ['image', 'mimes:jpeg,png,jpg', 'max:2048'];
            }

            if($request->password && $request->konfirmasi_password){
                $rules['password'] = ['required', 'same:konfirmasi_password', 'min:8', 'max:255'];
                $rules['konfirmasi_password'] = ['required', 'same:password', 'min:8', 'max:255'];
            }

            $request->validate($rules, $messages);

            Perawat::where('id_user', $user->id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            $namaFoto2 = $request->foto_lama;

            if($request->hasFile('foto')){
                if($namaFoto2){
                    Storage::delete($namaFoto2);
                }

                $foto = $request->file('foto');
    
                $ekstensiFoto = $foto->extension();
                $namaFoto = Str::random(40);
                $namaFoto = $namaFoto . '.' . $ekstensiFoto;
                $namaFoto2 = 'img/' . $namaFoto;
    
                $foto->move(storage_path('app\\public\\img'), $namaFoto);
            }

            if($request->hapus){
                Storage::delete($namaFoto2);
                $namaFoto2 = null;
            }

            $user->update([
                'nomor_handphone' => $request->nomor_handphone,
                'foto' => $namaFoto2,
            ]);

            if($request->password && $request->konfirmasi_password){
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            
            return redirect()->route('admin.perawat.edit', $request->nomor_handphone)->with('success', 'Data perawat berhasil diubah');
        }
    }

    public function destroyPerawat($id){
        $user = User::find($id);

        if(!$user){
            return redirect()->route('admin.perawat.index');
        }
        
        if($user->foto){
            Storage::delete($user->foto);
        }

        $user->delete();

        return back()->with('success', 'Perawat berhasil dihapus');
    }

    public function cariPerawat(Request $request){
        $kataKunci = $request->kataKunci;

        $perawats = DB::table('view_data_perawat')
            ->where(function ($query) use ($kataKunci) {
                $query->where('nama', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('nomor_handphone', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('alamat', 'LIKE', '%' . $kataKunci . '%');
            })
            ->get();

        return response()->json(['perawats' => $perawats]);
    }

    public function indexAntrian(){
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        $antrians = DB::table('view_reservasi')
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->where('tanggal', $tanggalHariIni)
            ->get();
        
        return view('admin.antrian', compact('antrians'));
    }

    public function indexAntrianTanggal(Request $request){
        $kataKunci = $request->kata_kunci;

        $antrians = DB::table('view_reservasi')
            ->where('tanggal', $request->tanggal)
            ->when($kataKunci, function($query) use ($kataKunci){
                $query->where(function($query) use ($kataKunci){
                    $query->where('nama_pasien', 'LIKE', '%' . $kataKunci . '%')
                        ->orWhere('jenis_kelamin', 'LIKE', '%' . $kataKunci . '%')
                        ->orWhere('nomor_handphone', 'LIKE', '%' . $kataKunci . '%')
                        ->orWhere('nama_dokter', 'LIKE', '%' . $kataKunci . '%')
                        ->orWhere('status', 'LIKE', '%' . $kataKunci . '%')
                        /* ->orWhere('waktu_rekomendasi', 'LIKE', '%' . $kataKunci . '%') */;
                    /* $query->whereNotNull('waktu_rekomendasi')
                        ->where(function($query) use ($kataKunci) {
                            $query->where('nama_pasien', 'LIKE', '%' . $kataKunci . '%')
                                ->orWhere('jenis_kelamin', 'LIKE', '%' . $kataKunci . '%')
                                ->orWhere('nomor_handphone', 'LIKE', '%' . $kataKunci . '%')
                                ->orWhere('nama_dokter', 'LIKE', '%' . $kataKunci . '%')
                                ->orWhere('status', 'LIKE', '%' . $kataKunci . '%')
                                ->orWhere('waktu_rekomendasi', 'LIKE', '%' . $kataKunci . '%');
                        }); */
                });
            })
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->get();

        return response()->json(['antrians' => $antrians]);
    }

    public function updateStatusAntrian(Request $request){
        $reservasi = Reservasi::find($request->id);

        if(!$reservasi){
            return response()->json(['failed' => 'Id tidak valid']);
        }
        if($reservasi->status != 'Menunggu'){
            return response()->json(['failed' => 'Antrian yang status nya sudah selesai dan batal tidak dapat diubah']);
        }

        $reservasi->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => 'Status antrian berhasil diubah']);
    }

    public function indexDokter(){
        $dokters = DB::table('view_data_dokter')->paginate(10);
        
        return view('admin.dokter-index', compact('dokters'));
    }

    public function createDokter(){
        return view('admin.dokter-input');
    }

    public function storeDokter(Request $request){
        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nama.max' => 'Kolom nama tidak boleh melebihi :max karakter.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
            'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'alamat.max' => 'Kolom alamat tidak boleh melebihi :max karakter.',
            'spesialis.required' => 'Kolom spesialis harus diisi.',
            'spesialis.in' => 'Spesialis yang dipilih tidak sesuai.',
            'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
            'password.required' => 'Kolom password harus diisi.',
            'password.same' => 'Password dan konfirmasi password harus sama.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.max' => 'Password tidak boleh melebihi :max karakter.',
            'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
            'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
            'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
            'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.',
            'foto.image' => 'File yang boleh dimasukkan berupa foto.',
            'foto.mimes' => 'Format foto yang diperbolehkan adalah: jpeg, png, jpg.',
            'foto.max' => 'Ukuran maksimal foto yang diunggah adalah 2 MB.',
        ];

        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'],
            'alamat' => ['required', 'string', 'max:255'],
            'spesialis' => ['required', 'in:Penyakit Dalam,Estetika,Obgyn'],
            'jenis_kelamin' => ['required', 'in:P,L'],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255'],
        ];

        if($request->hasFile('foto')){
            $rules['foto'] = ['image', 'mimes:jpeg,png,jpg', 'max:2048'];
        }

        $request->validate($rules, $messages);

        $namaFoto2 = null;

        if($request->hasFile('foto')){
            $foto = $request->file('foto');

            $ekstensiFoto = $foto->extension();
            $namaFoto = Str::random(40);
            $namaFoto = $namaFoto . '.' . $ekstensiFoto;
            $namaFoto2 = 'img/' . $namaFoto;

            $foto->move(storage_path('app\\public\\img'), $namaFoto);
        }

        User::create([
            'nomor_handphone' => $request->nomor_handphone,
            'password' => bcrypt($request->password),
            'status' => 'Dokter',
            'foto' => $namaFoto2,
            'aktif' => 1
        ]);

        Dokter::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'spesialis' => $request->spesialis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => User::latest()->first()->id
        ]);

        return back()->with('success', 'Dokter berhasil ditambah');
    }

    public function editDokter($nomorHandphone){
        $dokter = DB::table('view_data_dokter')
            ->where('nomor_handphone', $nomorHandphone)
            ->get();

        if($dokter->isEmpty()){
            return back();
        }

        $dokter = $dokter[0];

        return view('admin.dokter-edit', compact('dokter'));
    }

    public function updateDokter(Request $request, $id){
        $user = User::find($id);

        if(
            $request->nama == $user->dokter->nama &&
            $request->nomor_handphone == $user->nomor_handphone &&
            $request->alamat == $user->dokter->alamat &&
            $request->spesialis == $user->dokter->spesialis &&
            $request->jenis_kelamin == $user->dokter->jenis_kelamin &&
            !$request->hasFile('foto') &&
            !$request->password &&
            !$request->konfirmasi_password &&
            !$request->hapus
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }else{
            $messages = [
                'nama.required' => 'Kolom nama harus diisi.',
                'nama.max' => 'Kolom nama tidak boleh melebihi :max karakter.',
                'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
                'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
                'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
                'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
                'nomor_handphone.regex' => 'Nomor handphone tidak valid',
                'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
                'alamat.required' => 'Kolom alamat harus diisi.',
                'alamat.max' => 'Kolom alamat tidak boleh melebihi :max karakter.',
                'spesialis.required' => 'Kolom spesialis harus diisi.',
                'spesialis.in' => 'Spesialis yang dipilih tidak sesuai.',
                'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
                'foto.image' => 'File yang boleh dimasukkan berupa foto.',
                'foto.mimes' => 'Format foto yang diperbolehkan adalah: jpeg, png, jpg.',
                'foto.max' => 'Ukuran maksimal foto yang diunggah adalah 2 MB.',
                'password.required' => 'Kolom password harus diisi.',
                'password.same' => 'Password dan konfirmasi password harus sama.',
                'password.min' => 'Password harus terdiri dari minimal :min karakter.',
                'password.max' => 'Password tidak boleh melebihi :max karakter.',
                'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
                'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
                'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
                'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.',
            ];

            $rules = [
                'nama' => ['required', 'string', 'max:255'],
                'alamat' => ['required', 'string', 'max:255'],
                'spesialis' => ['required', 'in:Penyakit Dalam,Estetika,Obgyn'],
                'jenis_kelamin' => ['required', 'in:P,L'],
            ];

            if($request->nomor_handphone != $user->nomor_handphone){
                $rules['nomor_handphone'] = ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'];
            }

            if($request->hasFile('foto')){
                $rules['foto'] = ['image', 'mimes:jpeg,png,jpg', 'max:2048'];
            }

            if($request->password && $request->konfirmasi_password){
                $rules['password'] = ['required', 'same:konfirmasi_password', 'min:8', 'max:255'];
                $rules['konfirmasi_password'] = ['required', 'same:password', 'min:8', 'max:255'];
            }

            $request->validate($rules, $messages);

            Reservasi::where('nama_dokter', $user->dokter->nama)->update([
                'nama_dokter' => $request->nama,
                'spesialis' => $request->spesialis,
            ]);
            
            RekamMedis::where('nama_dokter', $user->dokter->nama)->update([
                'nama_dokter' => $request->nama,
                'spesialis' => $request->spesialis,
            ]);

            Dokter::where('id_user', $user->id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'spesialis' => $request->spesialis,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            $namaFoto2 = $request->foto_lama;

            if($request->hasFile('foto')){
                if($namaFoto2){
                    Storage::delete($namaFoto2);
                }

                $foto = $request->file('foto');
    
                $ekstensiFoto = $foto->extension();
                $namaFoto = Str::random(40);
                $namaFoto = $namaFoto . '.' . $ekstensiFoto;
                $namaFoto2 = 'img/' . $namaFoto;
    
                $foto->move(storage_path('app\\public\\img'), $namaFoto);
            }

            if($request->hapus){
                Storage::delete($namaFoto2);
                $namaFoto2 = null;
            }

            $user->update([
                'nomor_handphone' => $request->nomor_handphone,
                'foto' => $namaFoto2,
            ]);

            if($request->password && $request->konfirmasi_password){
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
            
            return redirect()->route('admin.dokter.edit', $request->nomor_handphone)->with('success', 'Data dokter berhasil diubah');
        }
    }

    public function destroyDokter($id){
        $user = User::find($id);

        if(!$user){
            return redirect()->route('admin.dokter.index');
        }
        
        if($user->foto){
            Storage::delete($user->foto);
        }

        $user->delete();

        return back()->with('success', 'Dokter berhasil dihapus');
    }

    public function cariDokter(Request $request){
        $kataKunci = $request->kataKunci;

        $dokters = DB::table('view_data_dokter')
            ->where(function ($query) use ($kataKunci) {
                $query->where('nama', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('nomor_handphone', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('jenis_kelamin', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('alamat', 'LIKE', '%' . $kataKunci . '%')
                    ->orWhere('spesialis', 'LIKE', '%' . $kataKunci . '%');
            })
            ->get();

        return response()->json(['dokters' => $dokters]);
    }

    public function editDokterJadwal($id){
        $dokter = DB::table('view_data_dokter')
            ->where('id_dokter', $id)
            ->first();

        if(!$dokter){
            return back();
        }

        $jadwal = DB::table('view_jadwal_dokter')
            ->where('id_dokter', $id)
            ->get();

        $waktus = Waktu::all();

        return view('admin.dokter-edit-jadwal', compact('dokter', 'jadwal', 'waktus'));
    }

    public function updateDokterJadwal(Request $request, $id){
        $jadwal = DB::table('view_jadwal_dokter')
            ->where('id_dokter', $id)
            ->get();

        $jamSenin = $jadwal->where('hari', 'Senin')->first();
        if($jamSenin){
            $jamSenin = $jamSenin->id_waktu;
        }
        $jamSelasa = $jadwal->where('hari', 'Selasa')->first();
        if($jamSelasa){
            $jamSelasa = $jamSelasa->id_waktu;
        }
        $jamRabu = $jadwal->where('hari', 'Rabu')->first();
        if($jamRabu){
            $jamRabu = $jamRabu->id_waktu;
        }
        $jamKamis = $jadwal->where('hari', 'Kamis')->first();
        if($jamKamis){
            $jamKamis = $jamKamis->id_waktu;
        }
        $jamJumat = $jadwal->where('hari', 'Jumat')->first();
        if($jamJumat){
            $jamJumat = $jamJumat->id_waktu;
        }
        $jamSabtu = $jadwal->where('hari', 'Sabtu')->first();
        if($jamSabtu){
            $jamSabtu = $jamSabtu->id_waktu;
        }
        $jamMinggu = $jadwal->where('hari', 'Minggu')->first();
        if($jamMinggu){
            $jamMinggu = $jamMinggu->id_waktu;
        }

        if(
            $jamSenin == $request->senin &&
            $jamSelasa == $request->selasa &&
            $jamRabu == $request->rabu &&
            $jamKamis == $request->kamis &&
            $jamJumat == $request->jumat &&
            $jamSabtu == $request->sabtu &&
            $jamMinggu == $request->minggu
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }

        $messages = [
            'senin.in' => 'Jam yang dipilih tidak valid.',
            'selasa.in' => 'Jam yang dipilih tidak valid.',
            'rabu.in' => 'Jam yang dipilih tidak valid.',
            'kamis.in' => 'Jam yang dipilih tidak valid.',
            'jumat.in' => 'Jam yang dipilih tidak valid.',
            'sabtu.in' => 'Jam yang dipilih tidak valid.',
            'minggu.in' => 'Jam yang dipilih tidak valid.',
        ];

        $inJamSenin = Waktu::where('hari', 'Senin')->pluck('id')->toArray();
        $inJamSenin = implode(',', $inJamSenin);

        $inJamSelasa = Waktu::where('hari', 'Selasa')->pluck('id')->toArray();
        $inJamSelasa = implode(',', $inJamSelasa);

        $inJamRabu = Waktu::where('hari', 'Rabu')->pluck('id')->toArray();
        $inJamRabu = implode(',', $inJamRabu);

        $inJamKamis = Waktu::where('hari', 'Kamis')->pluck('id')->toArray();
        $inJamKamis = implode(',', $inJamKamis);

        $inJamJumat = Waktu::where('hari', 'Jumat')->pluck('id')->toArray();
        $inJamJumat = implode(',', $inJamJumat);

        $inJamSabtu = Waktu::where('hari', 'Sabtu')->pluck('id')->toArray();
        $inJamSabtu = implode(',', $inJamSabtu);

        $inJamMinggu = Waktu::where('hari', 'Minggu')->pluck('id')->toArray();
        $inJamMinggu = implode(',', $inJamMinggu);

        $request->validate([
            'senin' => ['nullable', 'in:' . $inJamSenin],
            'selasa' => ['nullable', 'in:' . $inJamSelasa],
            'rabu' => ['nullable', 'in:' . $inJamRabu],
            'kamis' => ['nullable', 'in:' . $inJamKamis],
            'jumat' => ['nullable', 'in:' . $inJamJumat],
            'sabtu' => ['nullable', 'in:' . $inJamSabtu],
            'minggu' => ['nullable', 'in:' . $inJamMinggu],
        ], $messages);

        if($jamSenin && $request->senin && $jamSenin != $request->senin){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamSenin)
                ->update(['id_waktu' => $request->senin]);
        }else if(!$jamSenin && $request->senin){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->senin
            ]);
        }else if($jamSenin && !$request->senin){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamSenin)
                ->delete();
        }
        
        if($jamSelasa && $request->selasa && $jamSelasa != $request->selasa){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamSelasa)
                ->update(['id_waktu' => $request->selasa]);
        }else if(!$jamSelasa && $request->selasa){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->selasa
            ]);
        }else if($jamSelasa && !$request->selasa){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamSelasa)
                ->delete();
        }
        
        if($jamRabu && $request->rabu && $jamRabu != $request->rabu){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamRabu)
                ->update(['id_waktu' => $request->rabu]);
        }else if(!$jamRabu && $request->rabu){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->rabu
            ]);
        }else if($jamRabu && !$request->rabu){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamRabu)
                ->delete();
        }
        
        if($jamKamis && $request->kamis && $jamKamis != $request->kamis){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamKamis)
                ->update(['id_waktu' => $request->kamis]);
        }else if(!$jamKamis && $request->kamis){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->kamis
            ]);
        }else if($jamKamis && !$request->kamis){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamKamis)
                ->delete();
        }
        
        if($jamJumat && $request->jumat && $jamJumat != $request->jumat){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamJumat)
                ->update(['id_waktu' => $request->jumat]);
        }else if(!$jamJumat && $request->jumat){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->jumat
            ]);
        }else if($jamJumat && !$request->jumat){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamJumat)
                ->delete();
        }
        
        if($jamSabtu && $request->sabtu && $jamSabtu != $request->sabtu){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamSabtu)
                ->update(['id_waktu' => $request->sabtu]);
        }else if(!$jamSabtu && $request->sabtu){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->sabtu
            ]);
        }else if($jamSabtu && !$request->sabtu){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamSabtu)
                ->delete();
        }
        
        if($jamMinggu && $request->minggu && $jamMinggu != $request->minggu){ // update
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamMinggu)
                ->update(['id_waktu' => $request->minggu]);
        }else if(!$jamMinggu && $request->minggu){ // create
            JadwalDokter::create([
                'id_dokter' => $id,
                'id_waktu' => $request->minggu
            ]);
        }else if($jamMinggu && !$request->minggu){ // delete
            JadwalDokter::where('id_dokter', $id)
                ->where('id_waktu', $jamMinggu)
                ->delete();
        }

        return back()->with('success', 'Jadwal dokter berhasil diubah');
    }

    public function indexJadwalDokter(){
        $jadwals = Waktu::orderBy('hari')
            ->orderBy('jam')
            ->paginate(10);

        return view('admin.jadwal-dokter-index', compact('jadwals'));
    }

    public function createJadwalDokter(){
        return view('admin.jadwal-dokter-input');
    }

    public function storeJadwalDokter(Request $request){
        $messages = [
            'hari.required' => 'Silahkan pilih hari terlebih dahulu.',
            'hari.in' => 'Hari yang dipilih tidak valid.',
            'jam.required' => 'Kolom jam harus diisi.',
            'jam.regex' => 'Jam yang dimasukkan tidak valid.',
        ];

        $validated = $request->validate([
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam' => ['required', 'regex:/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]-(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
        ], $messages);

        $cek = Waktu::where('hari', $request->hari)
            ->where('jam', $request->jam)
            ->get();

        if(!$cek->isEmpty()){
            return back()->withInput()->with('failed', 'Jadwal dokter sudah ada');
        }

        $jam = explode('-', $request->jam);

        if($jam[0] == $jam[1]){
            return back()->withInput()->with('failed', 'Waktu awal dan akhir tidak boleh sama');
        }

        $jamAwal = Carbon::createFromFormat('H:i', $jam[0]);
        $jamAkhir = Carbon::createFromFormat('H:i', $jam[1]);

        if($jamAwal->gt($jamAkhir)){
            return back()->withInput()->with('failed', 'Waktu awal harus lebih kecil dari waktu akhir');
        }

        $selangWaktuJam = $jamAwal->diffInHours($jamAkhir);

        if($selangWaktuJam < 2){
            return back()->withInput()->with('failed', 'Selang waktu harus lebih besar sama dengan 2 jam');
        }

        Waktu::create($validated);

        return back()->with('success', 'Jadwal dokter berhasil ditambah');
    }

    public function editJadwalDokter($id){
        $jadwalDokter = Waktu::find($id);

        if(!$jadwalDokter){
            return redirect()->route('admin.jadwal.dokter.index');
        }

        return view('admin.jadwal-dokter-edit', compact('jadwalDokter'));
    }
    
    public function updateJadwalDokter(Request $request, $id){
        $jadwalDokter = Waktu::find($id);

        if(
            $jadwalDokter->hari == $request->hari &&
            $jadwalDokter->jam == $request->jam
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }

        $messages = [
            'hari.required' => 'Silahkan pilih hari terlebih dahulu.',
            'hari.in' => 'Hari yang dipilih tidak valid.',
            'jam.required' => 'Kolom jam harus diisi.',
            'jam.regex' => 'Jam yang dimasukkan tidak valid.',
        ];

        $validated = $request->validate([
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'],
            'jam' => ['required', 'regex:/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]-(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
        ], $messages);

        $cek = Waktu::where('hari', $request->hari)
            ->where('jam', $request->jam)
            ->get();

        if(!$cek->isEmpty()){
            return back()->withInput()->with('failed', 'Jadwal dokter sudah ada');
        }

        $jam = explode('-', $request->jam);

        if($jam[0] == $jam[1]){
            return back()->withInput()->with('failed', 'Waktu awal dan akhir tidak boleh sama');
        }

        $jamAwal = Carbon::createFromFormat('H:i', $jam[0]);
        $jamAkhir = Carbon::createFromFormat('H:i', $jam[1]);

        if($jamAwal->gt($jamAkhir)){
            return back()->withInput()->with('failed', 'Waktu awal harus lebih kecil dari waktu akhir');
        }

        $selangWaktuJam = $jamAwal->diffInHours($jamAkhir);

        if($selangWaktuJam < 2){
            return back()->withInput()->with('failed', 'Selang waktu harus lebih besar sama dengan 2 jam');
        }

        $jadwalDokter->update($validated);

        return back()->with('success', 'Jadwal dokter berhasil diubah');
    }

    public function destroyJadwalDokter($id){
        $waktu = Waktu::find($id);

        if(!$waktu){
            return redirect()->route('admin.jadwal.dokter.index');
        }
        
        try {
            $waktu->delete();
        } catch (\Throwable $th) {
            return back()->with('failed', 'Jadwal dokter ini digunakan, penghapusan tidak dapat dilakukan');
        }

        return back()->with('success', 'Jadwal dokter berhasil dihapus');
    }

    public function storeCariJadwalDokter(Request $request){
        $kataKunci = $request->kataKunci;

        $jadwalDokters = Waktu::where(function ($query) use ($kataKunci) {
            $query->where('hari', 'LIKE', '%' . $kataKunci . '%')
                ->orWhere('jam', 'LIKE', '%' . $kataKunci . '%');
        })
        ->orderBy('hari')
        ->orderBy('jam')
        ->get();

        return response()->json(['jadwal_dokters' => $jadwalDokters]);
    }

    public function editProfil(){
        return view('admin.profil');
    }

    public function updateProfil(Request $request){
        $user = User::find(auth()->user()->id);

        if( // tidak ada yang berubah
            $request->nama == $user->admin->nama &&
            $request->nomor_handphone == $user->nomor_handphone &&
            $request->alamat == $user->admin->alamat &&
            $request->jenis_kelamin == $user->admin->jenis_kelamin
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }
        
        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nama.max' => 'Maksimal 255 karakter.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'alamat.max' => 'Maksimal 255 karakter.',
            'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
            'nomor_handphone.unique' => 'Nomor handphone sudah terdaftar.',
        ];

        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:P,L'],
        ];

        if($request->nomor_handphone != $user->nomor_handphone){
            $rules['nomor_handphone'] = ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/', 'unique:users'];
        }

        $request->validate($rules, $messages);

        User::find(auth()->user()->id)->update([
            'nomor_handphone' => $request->nomor_handphone
        ]);

        Admin::where('id_user', auth()->user()->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return back()->with('success', 'Profil berhasil diubah');
    }
}