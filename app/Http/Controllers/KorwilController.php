<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\korwil;
use App\Models\Regency;
use Illuminate\Http\Request;

class KorwilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.datakorwil.index',[
            'korwil'=>korwil::all(),
            'city'=>Regency::all(),
            'user'=>User::all(),
            'grouped'=>korwil::orderBy('kota_id')->get()->groupBy(function($data){
                return $data->kota->name;
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valData=$request->validate([
        'PJ'=>'required|unique:korwils',
        'kota_id'=>'required|numeric',
        'number'=>'required|numeric|digits_between:10,13|unique:korwils',
        'kontaklain'=>'required|unique:korwils',
        'siswa_id'=>'required|numeric|unique:korwils',
        ]);
        korwil::create($valData);
        return redirect(route('korwil.index'))->with('success','Data Korwil Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
