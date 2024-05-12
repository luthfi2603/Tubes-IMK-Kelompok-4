<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function datapasien(){
        $pasien = DB::table('data_pasien')
        ->paginate(5);
        return view ('admin.data-pasien', compact('pasien'));
    }
    
}