<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\domainlist;
use App\Http\Requests\StoredomainlistRequest;
use App\Http\Requests\UpdatedomainlistRequest;

class DomainlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.domain.index',[
            'domain'=>domainlist::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.domain.buat',[
            'angkatan'=>Angkatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredomainlistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredomainlistRequest $request)
    {
        $validatedData=$request->validate([
            'name'=>'required|unique:domainlists',
            'email'=>'required|email:dns',
            'pj'=>'required',
            'angkatan_id'=>'required|digits_between:1,4'
        ]);
        $setor=domainlist::create($validatedData);
        if($setor){
            return redirect('/dashboard/domain')->with('success','Data domain berhasil ditambahkan');
        } else {
            return redirect('/dashboard/domain')->with('error','Terjadi kesalahan, ulangi input data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\domainlist  $domainlist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $domainlist=domainlist::where('id',$id)->first();
        return view('services.domain.detail',[
            'domain'=>$domainlist,
            'angkatan'=>angkatan::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\domainlist  $domainlist
     * @return \Illuminate\Http\Response
     */
    public function edit(domainlist $domainlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedomainlistRequest  $request
     * @param  \App\Models\domainlist  $domainlist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedomainlistRequest $request, $id)
    {
        $domainlist=domainlist::where('id',$id)->first();
        $rules=[
            'email'=>'required|email:dns',
            'pj'=>'required',
            'angkatan_id'=>'required|digits_between:1,4'
        ];
        if ($request->name!=$domainlist->name) {
            $rules['name']='required|unique:domainlists';
        }
        $validatedData=$request->validate($rules);
        $setor=domainlist::where('id',$domainlist->id)->update($validatedData);
        if($setor){
            return redirect('/dashboard/domain')->with('success','Berhasil update data domain');
        } else {
            return redirect('/dashboard/domain')->with('error','Terjadi kesalahan, ulangi edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\domainlist  $domainlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=domainlist::where('id',$id)->first();
        domainlist::destroy($data->id);
        return redirect(route('domain.index'))->with('success','Data domain berhasil di hapus');
    }
}
