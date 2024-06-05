<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Perawat;
use App\Models\RawatInap;
use App\Models\Reservasi;
use App\Models\RekamMedis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
    public function showDashboardAdmin(){
        return view('admin.dashboard');
    }

    public function dataPasien(){
        $pasien = DB::table('data_pasien')
            ->paginate(5);
            
        return view('admin.data-pasien', compact('pasien'));
    }

    public function dataKaryawan(){
        $karyawan = DB::table('data_karyawan')
            ->paginate(5);
            
        return view('admin.data-karyawan', compact('karyawan'));
    }

    public function editPasien($nohp){
        $pasien = Pasien::join('users', 'pasiens.id_user', '=', 'users.id')
            ->select('users.nomor_handphone', 'pasiens.nama', 'users.id', 'pasiens.alamat', 'pasiens.pekerjaan', 'pasiens.jenis_kelamin', 'pasiens.tanggal_lahir')
            ->where('users.nomor_handphone', $nohp)
            ->get();

        if($pasien->isEmpty()){
            return back();
        }

        $pasien = $pasien[0];

        return view('admin.edit-pasien', compact('pasien'));
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

            Pasien::where('id_user', $user->id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            $reservasi = Reservasi::where('nomor_handphone', $user->nomor_handphone)->get();
            if($reservasi){
                Reservasi::where('nomor_handphone', $user->nomor_handphone)->update([
                    'nama_pasien' => $request->nama,
                    'alamat' => $request->alamat,
                    'nomor_handphone' => $request->nomor_handphone,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }
            
            $rekamMedis = RekamMedis::where('nomor_handphone', $user->nomor_handphone)->get();
            if($rekamMedis){
                RekamMedis::where('nomor_handphone', $user->nomor_handphone)->update([
                    'nama_pasien' => $request->nama,
                    'pekerjaan' => $request['pekerjaan'],
                    'alamat' => $request->alamat,
                    'nomor_handphone' => $request->nomor_handphone,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }
            
            $rawatInap = RawatInap::where('nomor_handphone', $user->nomor_handphone)->get();
            if($rawatInap){
                RawatInap::where('nomor_handphone', $user->nomor_handphone)->update([
                    'nama_pasien' => $request->nama,
                    'alamat' => $request->alamat,
                    'nomor_handphone' => $request->nomor_handphone,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }

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
        return view('admin.tambah-pasien');
    }

    public function storePasien(Request $request){
        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
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
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/'],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:P,L'],
            'tanggal_lahir' => ['required', 'date'],
            'pekerjaan' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
        ], $messages);

        $user = User::where('nomor_handphone', $request->nomor_handphone)->first();

        if($user !== NULL){ // kalau user nya ada
            return back()->withInput()->with('failed', 'Nomor handphone sudah terdaftar');
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

        return redirect()->route('admin.data.pasien')->with('success', 'Data pasien berhasil ditambahkan!');
    }

    public function indexPerawat(){
        $perawats = DB::table('view_data_perawat')->paginate(10);
        
        return view('admin.kelola-perawat', compact('perawats'));
    }
    
    public function createPerawat(){
        return view('admin.input-perawat');
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

        return view('admin.edit-perawat', compact('perawat'));
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

        $antrians = DB::table('view_reservasi')->orderBy('updated_at')
            ->where('tanggal', $tanggalHariIni)
            ->get();
        
        return view('admin.antrian', compact('antrians'));
    }

    public function indexAntrianTanggal(Request $request){
        $antrians = DB::table('view_reservasi')->orderBy('updated_at')
            ->where('tanggal', $request->tanggal)
            ->get();

        return response()->json(['antrians' => $antrians]);
    }

    public function updateStatusAntrian(Request $request){
        $reservasi = Reservasi::find($request->id);

        $reservasi->update([
            'status' => $request->status
        ]);
    }
}