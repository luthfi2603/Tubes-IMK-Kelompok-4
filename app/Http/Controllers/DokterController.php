<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller {
    public function showDashboardDokter(){
        return view('dokter.dashboard');
    }
    
    public function indexRekamMedis(){
        return view('dokter.rekam-medis');
    }
    
    public function createRekamMedis(){
        return view('dokter.create-rekam-medis');
    }
}