<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.index');
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
