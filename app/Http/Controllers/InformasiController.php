<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Informasi;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\kateginfo;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.info.index',[
            'info'=>Informasi::with(['kateginfo','angkat','user'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role=='User'){
            return redirect(route('informasi.index'))->with('warning','Anda Tidak Punya Akses untuk halaman ini');
        }
        return view('services.info.create',[
            'kategori'=>kateginfo::all(),
            'angkatan'=>Angkatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInformasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInformasiRequest $request)
    {
        $validateData=$request->validate([
           'judul'=>'required|min:5',
            'kategori_informasi'=>'required',
            'angkatan'=>'required',
            'img'=>'required|file|image|mimes:png,jpg,svg',
            'body'=>'required'
        ]);
        if ($request->file('img')) {
            $validateData['img']=$request->file('img')->store('app-image');
        }
        $validateData['oleh']=auth()->user()->id;
        Informasi::create($validateData);
        return redirect(route('informasi.index'))->with('success','Berhasil Menambahkan Informasi Baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function show(Informasi $informasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasi $informasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInformasiRequest  $request
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInformasiRequest $request, Informasi $informasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informasi  $informasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasi $informasi)
    {
        //
    }
}
