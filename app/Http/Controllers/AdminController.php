<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->get()
            ->firstOrFail();

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

            $user->update([
                'nomor_handphone' => $request->nomor_handphone
            ]);
            
            return redirect()->route('admin.edit.pasien', $request->nomor_handphone)->with('success', 'Data pasien berhasil diubah');
        }
    }
}