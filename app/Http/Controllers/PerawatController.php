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
        $tanggalHariIni = Carbon::now()->format('Y-m-d');

        $jumlahReservasi = DB::table('view_reservasi')
            ->select('nama_pasien')
            ->where('tanggal', $tanggalHariIni)
            ->count();
        
        $dokters = DB::table('view_data_dokter')
            ->limit(4)
            ->get();

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

        return view('perawat.dashboard', compact('dokters', 'antrians', 'jumlahPasien', 'pasiens', 'jumlahReservasi'));
    }

    public function indexPasien(){
        $users = User::whereHas('pasien')
            ->with('pasien')
            ->orderBy(Pasien::select('nama')->whereColumn('pasiens.id_user', 'users.id'), 'asc')
            ->paginate(10);
            
        return view('perawat.pasien-index', compact('users'));
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

        return view('perawat.dokter-index', compact('dokters', 'jadwals'));
    }

    public function showProfil(){
        return view('perawat.profil');
    }
}