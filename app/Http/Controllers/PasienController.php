<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller {
    public function showDashboardPasien(){
        return view('dashboard');
    }
    
    public function editProfil(){
        return view('profil');
    }
}