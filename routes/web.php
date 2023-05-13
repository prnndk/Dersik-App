<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\BlastMailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashboardUserController;
use App\Http\Controllers\DashlinkController;
use App\Http\Controllers\DataketuaController;
use App\Http\Controllers\DetailstatusController;
use App\Http\Controllers\DomainlistController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KateginfoController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KetuaController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\RegisEmailController;
use App\Http\Controllers\RegisPromController;
use App\Http\Controllers\ShortlinkController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TempatstatusController;
use App\Http\Controllers\UserdataQRController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/maintenance', function () {
    return view('maintenance');
});
Route::get('/korwil', [DashboardController::class, 'korwil']);
Route::get('pendataan/public', [SiswaController::class, 'publicform'])->name('publicform');
Route::get('pendataan/cek/{url}', [SiswaController::class, 'cekpendataan'])->name('cekPendataan');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/dashboard/korwil', \App\Http\Controllers\KorwilController::class)->middleware('admin');
    Route::resource('voting', \App\Http\Controllers\VoteController::class)->middleware('admin');
    Route::controller(KateginfoController::class)->group(function () {
        Route::get('/info/kategori', 'create')->name('makeKateginfo')->middleware('admin');
        Route::put('/info/kategori/{kateginfos:id}', 'edit')->name('kategInfo.edit')->middleware('admin');
        Route::post('/info/kategstore', 'store')->name('kategInfoStore')->middleware('admin');
        Route::delete('/info/kateg/delete/{kateinfos:id}', 'destroy')->name('kateg.destroy')->middleware('admin');
    });
    Route::resource('/userlist', dashboardUserController::class)->middleware('admin')->parameters(['userlist' => 'user']);
    Route::resource('/pemilih', PemilihController::class)->middleware('admin');
    Route::get('/dashboard/scan', [RegisPromController::class, 'scan'])->middleware('admin');
    Route::post('/dashboard/verifQR', [RegisPromController::class, 'verifikasi'])->middleware('admin')->name('verifikasiQR');
    Route::resource('/userdata', UserdataQRController::class)->middleware('admin');
    Route::resource('/dashboard/domain', DomainlistController::class)->middleware('admin');
    Route::resource('/dashboard/dataketua', DataketuaController::class)->middleware('admin');
    Route::get('export/user', [dashboardUserController::class, 'exportuser'])->middleware('admin')->name('exportuser');
    Route::post('import/user', [dashboardUserController::class, 'importuser'])->middleware('admin')->name('import.user');

    Route::resource('/dashboard/formprom', RegisPromController::class);
    Route::resource('/informasi', InformasiController::class);
    Route::resource('/pendataan', SiswaController::class)->except(['show', 'update']);
    Route::put('/pendataan/{url}', [SiswaController::class, 'update'])->name('pendataan.update');
    Route::get('/pendataan/{url}', [SiswaController::class, 'show'])->name('pendataan.show');
    Route::resource('/dashboard/kelas', KelasController::class);
    Route::get('/dashboard/informasipembayaran', [RegisPromController::class, 'infobayar']);
    Route::get('/dashboard/undangan', [RegisPromController::class, 'undangan']);

    Route::resource('/dashboard/regis-mail', RegisEmailController::class);
    Route::resource('blasting-mail', BlastMailController::class);
    Route::resource('/dashboard/ketua', KetuaController::class);
    Route::resource('/dashboard/angkatan', AngkatanController::class);

    Route::resource('/data/status', StatusController::class);
    Route::resource('/data/instansi', DetailstatusController::class);
    Route::resource('/data/detail-status', TempatstatusController::class);
    Route::resource('/agenda', AgendaController::class);
    Route::controller(PemilihController::class)->group(function () {
        Route::get('/vote', 'homevote')->name('vote');
        Route::get('/vote/me', 'usertoken')->name('usertoken');
        Route::get('/vote/pilih/{vote:link}', 'milih')->name('pilihHome');
        Route::get('/vote/end', 'logouttoken')->name('logoutVote');
        Route::post('/vote/cek', 'cektoken')->name('cekToken');
        Route::get('/vote/simpan/{id}', 'simpan')->name('simpan');
        Route::get('/api/calon/{id}', 'fetchcalon')->name('getDataCalon');
        Route::get('/vote/qc/{vote:link}', 'lihathasil')->name('quickcount');
        Route::post('/pemilih/generate/angkatan', 'angkatgenerate')->name('generateAngkat')->middleware('admin');
        Route::post('/pemilih/generate/all', 'allgenerate')->name('generateAll')->middleware('admin');
    });
    // Route::controller(SiswaController::class)->group(function(){
//     Route::post('/api/dtlstts','cekDetail')->name('cekDetail');
    // });
    Route::resource('/dashboard/links', DashlinkController::class)->middleware('admin')->except(['create', 'show']);
    Route::get('api/link', [DashlinkController::class, 'apiLink'])->name('apiLink')->middleware('admin');
    Route::get('shortlink', [DashboardController::class, 'shortlink'])->name('shortlink');
    // Route::get('testnotif', function () {
    //     Notification::send(User::first(), new \App\Notifications\NotifyBot('test'));
    // });
    Route::get('cache_clear', function () {
        Artisan::call('cache:clear');

        return redirect('/dashboard')->with('success', 'Cache berhasil dihapus');
    });
    Route::get('config_clear', function () {
        Artisan::call('config:clear');

        return redirect('/dashboard')->with('success', 'Config berhasil dihapus');
    });
    Route::get('route_clear', function () {
        Artisan::call('route:clear');

        return redirect('/dashboard')->with('success', 'Route berhasil dihapus');
    });
    Route::get('link_storage', function () {
        Artisan::call('storage:link');

        return redirect('/dashboard')->with('success', 'Link storage berhasil dibuat');
    });
});
// end group of auth
Route::get('to/{Shortlink:shortened}', [ShortlinkController::class, 'show'])->name('shortenedlink');
