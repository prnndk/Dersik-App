<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\korwil;
use App\Models\pemilih;
use App\Models\Informasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function dashboard()
    {
        $jam=Carbon::now()->format('H');
        if($jam<12)
        {
            $greet="Good Morning";
            $banner="banner-pagi.jpg";
            $icon="bi-cloud-sun";
            $text='dark';
        }
        elseif($jam<15){
            $greet="Good Afternoon";
            $banner="banner-siang.jpg";
            $icon="bi-sun";
            $text='dark';
        }
        else{
            $greet="Good Evening";
            if($jam<18&&$jam>=15)
            {
                $banner="banner-sore.jpg";
            }else{
                $banner="banner-malam.jpg";
            }
            $icon="bi-moon-stars";
            $text="white";
        }
        return view('dashboard',[
            'info'=>Informasi::latest()->first(),
            'siswa'=>siswa::count(),
            'voter'=>pemilih::count(),
            'greet'=>$greet,
            'gambar'=>$banner,
            'icon'=>$icon,
            'text'=>$text
        ]);
    }

    public function shortlink()
    {
       return view('services.shortlink');
    }
}
