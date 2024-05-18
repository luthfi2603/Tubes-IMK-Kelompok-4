<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller {
    public function showDashboardDokter(){
        return view('dokter.dashboard');
    }
}