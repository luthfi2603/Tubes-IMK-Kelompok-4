<?php

namespace App\Http\Controllers;

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
        dd($request->all());
        $user = User::find(auth()->user()->id);

        if(
            $request->nama == $user->pasien->nama &&
            $request->nomor_handphone == $user->nomor_handphone &&
            $request->alamat == $user->pasien->alamat &&
            $request->pekerjaan == $user->pasien->pekerjaan
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }

        return back()->with('success', 'Profil berhasil diubah');
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