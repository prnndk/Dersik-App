<?php

use App\Models\siswa;
use App\Models\Informasi;
use App\Models\RegisProm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataketuaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\RegisPromController;
use App\Http\Controllers\DomainlistController;
use App\Http\Controllers\RegisEmailController;
use App\Http\Controllers\UserdataQRController;
use App\Http\Controllers\DetailstatusController;
use App\Http\Controllers\TempatstatusController;
use App\Http\Controllers\dashboardUserController;
use App\Http\Controllers\KateginfoController;
use App\Models\pemilih;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[DashboardController::class,'index']);
Route::get('/korwil',[DashboardController::class,'korwil']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard',[
            'info'=>informasi::latest()->first(),
            'siswa'=>siswa::count(),
            'voter'=>pemilih::count()
        ]);
    })->name('dashboard');
});
Route::resource('/dashboard/formprom', RegisPromController::class)->middleware('auth');
Route::resource('/informasi', InformasiController::class)->middleware('auth');
Route::resource('/pendataan', SiswaController::class)->middleware('auth');
Route::resource('/dashboard/kelas', KelasController::class)->middleware('auth');
Route::resource('/userlist', dashboardUserController::class)->middleware('admin');
Route::get('/dashboard/informasipembayaran', [RegisPromController::class, 'infobayar'] )->middleware('auth');
Route::get('/dashboard/undangan', [RegisPromController::class, 'undangan'] )->middleware('auth');
Route::get('/dashboard/scan', [RegisPromController::class, 'scan'] )->middleware('admin');
Route::post('/dashboard/verifQR', [RegisPromController::class, 'verifikasi'] )->middleware('admin')->name('verifikasiQR');
Route::resource('/userdata', UserdataQRController::class)->middleware('admin');
Route::resource('/dashboard/regis-mail',RegisEmailController::class)->middleware('auth');
Route::resource('/dashboard/ketua',KetuaController::class)->middleware('auth');
Route::resource('/dashboard/angkatan',AngkatanController::class)->middleware('auth');
Route::resource('/dashboard/domain',DomainlistController::class)->middleware('admin');
Route::resource('/dashboard/dataketua',DataketuaController::class)->middleware('admin');
Route::resource('/data/status',StatusController::class)->middleware('auth');
Route::resource('/data/instansi',DetailstatusController::class)->middleware('auth');
Route::resource('/data/detail-status',TempatstatusController::class)->middleware('auth');
Route::resource('/pemilih',PemilihController::class)->middleware('admin');
Route::controller(PemilihController::class)->group(function(){
    Route::get('/vote','homevote')->name('vote')->middleware('auth');
    Route::get('/vote/me','usertoken')->name('usertoken')->middleware('auth');
    Route::get('/vote/pilih/{vote:link}','milih')->name('pilihHome')->middleware('auth');
    Route::get('/vote/end','logouttoken')->name('logoutVote')->middleware('auth');
    Route::post('/vote/cek','cektoken')->name('cekToken');
    Route::get('/vote/simpan/{id}','simpan')->name('simpan')->middleware('auth');
    Route::get('/api/calon/{id}','fetchcalon')->name('getDataCalon')->middleware('auth');
    Route::get('/vote/qc/{vote:link}','lihathasil')->name('quickcount')->middleware('auth');
    Route::post('/pemilih/generate/angkatan','angkatgenerate')->name('generateAngkat')->middleware('admin');
    Route::post('/pemilih/generate/all','allgenerate')->name('generateAll')->middleware('admin');
});
Route::controller(SiswaController::class)->group(function(){
    Route::post('/api/dtlstts','cekDetail')->name('cekDetail')->middleware('auth');
});
Route::resource('/dashboard/korwil',\App\Http\Controllers\KorwilController::class)->middleware('admin');
Route::resource('voting',\App\Http\Controllers\VoteController::class)->middleware('admin');
Route::controller(KateginfoController::class)->group(function(){
    Route::get('/info/kategori','create')->name('makeKateginfo')->middleware('admin');
    Route::put('/info/kategori/{kateginfos:id}','edit')->name('kategInfo.edit')->middleware('admin');
    Route::post('/info/kategstore','store')->name('kategInfoStore')->middleware('admin');
    Route::delete('/info/kateg/delete/{kateinfos:id}','destroy')->name('kateg.destroy')->middleware('admin');
});

