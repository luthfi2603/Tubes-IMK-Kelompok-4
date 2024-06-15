<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Perawat;
use App\Models\Dokter;
use App\Models\Reservasi;
use App\Models\RekamMedis;
use App\Models\Waktu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PerawatController extends Controller {
    public function showDashboardPerawat(){
        return view('perawat.dashboard');
    }

    public function indexPasien(){
        $users = User::whereHas('pasien')
            ->with('pasien')
            ->orderBy(Pasien::select('nama')->whereColumn('pasiens.id_user', 'users.id'), 'asc')
            ->paginate(10);
            
        return view('perawat.pasien', compact('users'));
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

    public function editPasien($nohp){
        $pasien = Pasien::join('users', 'pasiens.id_user', '=', 'users.id')
            ->select('users.nomor_handphone', 'pasiens.nama', 'users.id', 'pasiens.alamat', 'pasiens.pekerjaan', 'pasiens.jenis_kelamin', 'pasiens.tanggal_lahir')
            ->where('users.nomor_handphone', $nohp)
            ->get();

        if($pasien->isEmpty()){
            return back();
        }

        $pasien = $pasien[0];

        return view('perawat.edit-pasien', compact('pasien'));
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
            
            return redirect()->route('perawat.edit.pasien', $request->nomor_handphone)->with('success', 'Data pasien berhasil diubah');
        }
    }

    public function banPasien($nomor_handphone){
        $pasien = User::where('nomor_handphone', $nomor_handphone)->first();
        if ($pasien) {
            $pasien->aktif = 0; // Update aktif to banned
            $pasien->save();
        }
        return redirect()->route('perawat.data.pasien')->with('success', 'Pasien berhasil diblokir');
    }

    public function unbanPasien($nomor_handphone){
        $pasien = User::where('nomor_handphone', $nomor_handphone)->first();
        if ($pasien) {
            $pasien->aktif = 1; // Update status to unbanned
            $pasien->save();
        }
        return redirect()->route('perawat.data.pasien')->with('success', 'Pasien berhasil diaktifkan kembali');
    }

    public function createPasien(){
        $nomorHandphone = request()->query('nomor_handphone');

        return view('perawat.tambah-pasien', compact('nomorHandphone'));
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

        return redirect()->route('perawat.data.pasien')->with('success', 'Data pasien berhasil ditambahkan!');
    }
    
    public function indexAntrian(){
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        $antrians = DB::table('view_reservasi')
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->where('tanggal', $tanggalHariIni)
            ->get();
        
        return view('perawat.antrian', compact('antrians'));
    }

    public function indexAntrianTanggal(Request $request){
        $antrians = DB::table('view_reservasi')
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->where('tanggal', $request->tanggal)
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
        
        return view('perawat.kelola-dokter', compact('dokters'));
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

    public function indexJadwalDokter(){
        $jadwals = Waktu::orderBy('hari')
            ->orderBy('jam')
            ->paginate(10);

        return view('perawat.kelola-jadwal-dokter', compact('jadwals'));
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

    public function showProfil(){
        return view('perawat.profil');
    }
}