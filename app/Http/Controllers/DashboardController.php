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
        return view('dashboard'); 
    }
    
    public function indexOrganizer()
    {
        return view('pages.organizer.dashboard');
    }
    
    public function indexUser()
    {
        return view('user.index');
    }
}
