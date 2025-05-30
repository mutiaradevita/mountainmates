<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

     public function indexAdmin()
    {
        return view('admin.index'); // opsional, sesuai view yang kamu buat
    }
    
    public function indexEo()
    {
        return view('eo.index');
    }
    
    public function indexUser()
    {
        return view('user.index');
    }
}
