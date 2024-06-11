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
        $rekammedis = RekamMedis::where('nama_dokter', auth()->user()->dokter->nama)
        ->whereDate('created_at', $tanggalHariIni)
        ->get();
        return view('dokter.rekam-medis', compact('rekammedis'));
    }
    
    public function createRekamMedis(){
        return view('dokter.create-rekam-medis');
    }

    public function storeRekamMedis(Request $request, $id){
        $reservasi = Reservasi::where('nama_dokter', auth()->user()->dokter->nama)
        ->where('id', $id)
        ->first();
    
    // Check if the reservation exists
        if (!$reservasi) {
            return back();
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
        ]);
       return back()->with('success', 'Rekam Medis Berhasil Dibuat');
    }

    public function showRekamMedis($id) {

    $rekammedis = RekamMedis::find($id);

    return view('dokter.detail-rekam-medis', compact('rekammedis'));
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
        $rekammedis = RekamMedis::whereDate('created_at', $request->tanggal)
            ->where('nama_dokter', auth()->user()->dokter->nama)
            ->get();
        return response()->json(['rekammedis' => $rekammedis]);
    }
    
}