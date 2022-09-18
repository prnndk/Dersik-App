<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\ketua;
use App\Models\dataketua;
use App\Http\Requests\StoredataketuaRequest;
use App\Http\Requests\UpdatedataketuaRequest;
use App\Models\Regency;

class DataketuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('milih.data.dataketua',[
            'ketuadata'=>dataketua::with(['kelases','ketua','kota'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('milih.data.tambah',[
            'ketua'=>ketua::all(),
            'kelas'=>kelas::all(),
            'kab'=>Regency::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredataketuaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredataketuaRequest $request)
    {
        $validatedData=$request->validate([
            'ketua_id'=>'required|unique:dataketuas',
            'kelas'=>'required',
            'tempatlahir'=>'required',
            'dob'=>'required|date',
            'pengalaman'=>'required',
            'ig'=>'required'
        ]);
        $setor=dataketua::create($validatedData);
        if($setor){
            return redirect('/dashboard/dataketua')->with('success','Data ketua berhasil ditambahkan');
        } else {
            return redirect('/dashboard/dataketua')->with('error','Terjadi kesalahan, ulangi input data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dataketua  $dataketua
     * @return \Illuminate\Http\Response
     */
    public function show(dataketua $dataketua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dataketua  $dataketua
     * @return \Illuminate\Http\Response
     */
    public function edit(dataketua $dataketua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedataketuaRequest  $request
     * @param  \App\Models\dataketua  $dataketua
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedataketuaRequest $request, dataketua $dataketua)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dataketua  $dataketua
     * @return \Illuminate\Http\Response
     */
    public function destroy(dataketua $dataketua)
    {
        //
    }
}
