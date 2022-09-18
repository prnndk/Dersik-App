<?php

namespace App\Http\Controllers;

use App\Models\korwil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index',[
            
        ]);
    }
    public function korwil()
    {
        return view('korwil',[
           'korwils'=>korwil::all()
        ]);
    }
}
