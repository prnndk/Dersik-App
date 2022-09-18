<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\siswa;
use App\Models\status;
use App\Models\Regency;
use App\Models\Angkatan;
use App\Models\detailstatus;
use App\Models\tempatstatus;
use Illuminate\Http\Request;
use App\Http\Requests\StoresiswaRequest;
use App\Http\Requests\UpdatesiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.pendataan.index',[
            'datum'=>Siswa::where('user_id',auth()->user()->id)->get(),
            'admin'=>Siswa::all(),
            'status'=>status::all(),
            'cs1'=>siswa::where('status','1')->count(),
            'cs2'=>siswa::where('status','2')->count(),
            'cs3'=>siswa::where('status','3')->count(),
            'cs4'=>siswa::where('status','4')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.pendataan.create',[
            'kelas'=>kelas::all(),
            'kab'=>Regency::all(),
            'angkatan'=>Angkatan::all(),
            'status'=>status::all(),
            'instansi'=>detailstatus::all(),
            'detail_status'=>tempatstatus::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoresiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresiswaRequest $request)
    {
        $validated=$request->validate([
            'nama'=>'required|unique:siswas',
            'kelas'=>'required',
            'status'=>'required',
            'detail_status'=>'required',
            'tempat'=>'required',
            'domisili'=>'required',
            'teman_smasa'=>'required',
            'nomor'=>'required|digits_between:10,13|unique:siswa'
        ]);
        $validated['user_id']=auth()->user()->id;
        $store=Siswa::create($validated);
        if ($store){
            return redirect(route('pendataan.index'))->with('success','Terimakasih Telah Mengisi Pendataan');
        } else {
           return redirect(route('pendataan.index'))->with('error','Terjadi Kesalahan Ulangi Pengisian Form Anda');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesiswaRequest  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesiswaRequest $request, siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswa $siswa)
    {
        //
    }

    public function cekDetail(Request $req)
    {
       $detail=detailstatus::where('id_status',$req->id_status)->get();
        return response()->json([
        'status'=>200,
        'detail'=>$detail
       ]);
    }
}
