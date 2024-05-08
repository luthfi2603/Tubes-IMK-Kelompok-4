<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller {
    public function index(){
        return view('index');
    }

    public function showDashboardPasien(){
        return view('dashboard');
    }
}