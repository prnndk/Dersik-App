<?php

namespace App\Http\Controllers;

use App\Models\dashlink;
use App\Models\Informasi;
use App\Models\korwil;
use App\Models\pemilih;
use App\Models\siswa;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index', [
            'buttons'=>dashlink::where('active', true)->where('location','2')->get(),
        ]);
    }

    public function korwil()
    {
        return view('korwil', [
           'korwils' => korwil::all(),
        ]);
    }

    public function dashboard()
    {
        $jam = Carbon::now()->format('H');
        if ($jam < 12) {
            $greet = 'Good Morning';
            $banner = 'banner-pagi.jpg';
            $icon = 'bi-cloud-sun';
            $text = 'dark';
        } elseif ($jam < 15) {
            $greet = 'Good Afternoon';
            $banner = 'banner-siang.jpg';
            $icon = 'bi-sun';
            $text = 'dark';
        } else {
            $greet = 'Good Evening';
            if ($jam < 18 && $jam >= 15) {
                $banner = 'banner-sore.jpg';
            } else {
                $banner = 'banner-malam.jpg';
            }
            $icon = 'bi-moon-stars';
            $text = 'white';
        }

        return view('dashboard', [
            'info' => Informasi::latest()->first(),
            'siswa' => siswa::count(),
            'voter' => pemilih::count(),
            'greet' => $greet,
            'gambar' => $banner,
            'icon' => $icon,
            'text' => $text,
            'button' => dashlink::where('active', true)->where('location','1')->get(),
        ]);
    }

    public function shortlink()
    {
        return view('services.shortlink');
    }
}
