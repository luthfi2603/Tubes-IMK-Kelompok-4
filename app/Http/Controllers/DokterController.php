<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller {
    public function showDashboardDokter(){
        return view('dokter.dashboard');
    }
    
    public function indexRekamMedis(){
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        $rekamMedis = RekamMedis::where('nama_dokter', auth()->user()->dokter->nama)
            ->whereDate('created_at', $tanggalHariIni)
            ->oldest()
            ->get();
        
        return view('dokter.rekam-medis', compact('rekamMedis'));
    }
    
    public function createRekamMedis($id){
        $reservasi = Reservasi::where('nama_dokter', auth()->user()->dokter->nama)
            ->where('id', $id)
            ->first();
    
        if (!$reservasi) {
            return back();
        }

        return view('dokter.create-rekam-medis');
    }

    public function storeRekamMedis(Request $request, $id){
        $messages = [
            'keluhan.required' => 'Kolom keluhan harus diisi.',
            'keluhan.max' => 'Kolom keluhan tidak boleh lebih dari :max character.',
            'diagnosa.required' => 'Kolom diagnosa harus diisi.',
            'diagnosa.max' => 'Kolom diagnosa tidak boleh lebih dari :max character.',
            'therapie.required' => 'Kolom therapie harus diisi.',
            'therapie.max' => 'Kolom therapie tidak boleh lebih dari :max character.',
        ];

        $request->validate([
            'keluhan' => ['required', 'max:65535'],
            'diagnosa' => ['required', 'max:65535'],
            'therapie' => ['required', 'max:65535'],
        ], $messages);

        $reservasi = Reservasi::where('nama_dokter', auth()->user()->dokter->nama)
            ->where('id', $id)
            ->first();

        if(!$reservasi){
            return back();
        }

        if($reservasi->id_rekam_medis){
            return back()->with('failed', 'Rekam medis sudah ada');
        }

        $pasien = Pasien::select('pekerjaan')
            ->where('nama', $reservasi->nama_pasien)
            ->first();
  
        RekamMedis::create([
            'nama_pasien' => $reservasi->nama_pasien,
            'umur' => $reservasi->umur,
            'jenis_kelamin' => $reservasi->jenis_kelamin,
            'pekerjaan' => $pasien->pekerjaan,
            'alamat' => $reservasi->alamat,
            'nomor_handphone' => $reservasi->nomor_handphone,
            'nama_dokter' => $reservasi->nama_dokter,
            'spesialis' => $reservasi->spesialis,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'therapie' => $request->therapie,
            'foto' => $reservasi->foto,
        ]);

        $reservasi->update([
            'id_rekam_medis' => RekamMedis::latest()->first()->id
        ]);

        return back()->with('success', 'Rekam Medis Berhasil Dibuat');
    }

    public function editRekamMedis($id){
        $rekamMedis = RekamMedis::where('nama_dokter', auth()->user()->dokter->nama)
            ->where('id', $id)
            ->first();
    
        if (!$rekamMedis) {
            return back();
        }

        return view('dokter.rekam-medis-edit', compact('rekamMedis'));
    }

    public function updateRekamMedis(Request $request, $id){
        $rekamMedis = RekamMedis::where('nama_dokter', auth()->user()->dokter->nama)
            ->where('id', $id)
            ->first();

        if (!$rekamMedis) {
            return back();
        }

        if(
            $rekamMedis->keluhan == $request->keluhan &&
            $rekamMedis->diagnosa == $request->diagnosa &&
            $rekamMedis->therapie == $request->therapie 
        ){
            return back()->with('failed', 'Gagal diubah, tidak ada perubahan');
        }

        $messages = [
            'keluhan.required' => 'Kolom keluhan harus diisi.',
            'keluhan.max' => 'Kolom keluhan tidak boleh lebih dari :max character.',
            'diagnosa.required' => 'Kolom diagnosa harus diisi.',
            'diagnosa.max' => 'Kolom diagnosa tidak boleh lebih dari :max character.',
            'therapie.required' => 'Kolom therapie harus diisi.',
            'therapie.max' => 'Kolom therapie tidak boleh lebih dari :max character.',
        ];

        $request->validate([
            'keluhan' => ['required', 'max:65535'],
            'diagnosa' => ['required', 'max:65535'],
            'therapie' => ['required', 'max:65535'],
        ], $messages);

        $rekamMedis->update([
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'therapie' => $request->therapie,
        ]);

        return back()->with('success', 'Rekam Medis Berhasil Diubah');
    }

    public function destroyRekamMedis($id){
        $rekamMedis = RekamMedis::where('nama_dokter', auth()->user()->dokter->nama)
            ->where('id', $id)
            ->first();
    
        if (!$rekamMedis) {
            return back();
        }

        $rekamMedis->delete();

        $reservasi = Reservasi::where('nama_dokter', auth()->user()->dokter->nama)
            ->where('id_rekam_medis', $id)
            ->first();

        $reservasi->update(['id_rekam_medis' => null]);

        return back()->with('success', 'Rekam Medis Berhasil Dihapus');
    }

    public function showRekamMedis($id){
        $rekamMedis = RekamMedis::find($id);

        if(!$rekamMedis){
            return back();
        }

        return view('dokter.detail-rekam-medis', compact('rekamMedis'));
    }

    public function indexAntrian(){
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        $antrians = DB::table('view_reservasi')
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->where('tanggal', $tanggalHariIni)
            ->where('nama_dokter', auth()->user()->dokter->nama)
            ->get();
        
        return view('dokter.appointment-dokter', compact('antrians'));
    }

    public function indexAntrianTanggal(Request $request){
        $antrians = DB::table('view_reservasi')
            ->orderByRaw('ISNULL(waktu_rekomendasi), waktu_rekomendasi')
            ->where('tanggal', $request->tanggal)
            ->where('nama_dokter', auth()->user()->dokter->nama)
            ->get();

        return response()->json(['antrians' => $antrians]);
    }
    
    public function indexRekamMedisTanggal(Request $request){
        $rekamMedis = RekamMedis::whereDate('created_at', $request->tanggal)
            ->where('nama_dokter', auth()->user()->dokter->nama)
            ->oldest()
            ->get();

        return response()->json(['rekam_medis' => $rekamMedis]);
    }

    public function showProfil(){
        return view('dokter.profil');
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

        return view('dokter.dokter-kami', compact('dokters', 'jadwals'));
    }
}