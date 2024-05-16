<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {
    public function datapasien(){
        $pasien = DB::table('data_pasien')
            ->paginate(5);
            
        return view ('admin.data-pasien', compact('pasien'));
    }
    public function datakaryawan(){
        $karyawan = DB::table('data_karyawan')
            ->paginate(5);
            
        return view ('admin.data-karyawan', compact('karyawan'));
    }
}