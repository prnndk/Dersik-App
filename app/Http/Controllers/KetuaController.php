<?php

namespace App\Http\Controllers;

use App\Models\vote;
use App\Models\kelas;
use App\Models\ketua;
use App\Models\Regency;
use App\Models\dataketua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreketuaRequest;
use App\Http\Requests\UpdateketuaRequest;
use App\Models\detailstatus;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('milih.calon.index',[
            'info'=>dataketua::all(),
            'calon'=>ketua::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('milih.calon.tambah',[
            'voting'=>vote::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreketuaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreketuaRequest $request)
    {
        $validatedData=$request->validate([
            'nama'=>'required|unique:ketuas|min:5',
            'panggilan'=>'required|unique:ketuas|min:4',
            'pemilihan_id'=>'required',
            'img'=>'image|file|mimes:png,jpg,svg'
        ]);
        if ($request->file('img')) {
            $validatedData['img']=$request->file('img')->store('app-image');
        }
        $validatedData['suara']=0;
        $create=ketua::create($validatedData);
        if ($create) {
            return redirect('/dashboard/ketua')->with('success','Calon ketua berhasil ditambahkan!');
        } else {
            return redirect('/dashboard/ketua')->with('error','Gagal menambahkan calon ketua');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ketua  $ketua
     * @return \Illuminate\Http\Response
     */
    public function show(ketua $ketua)
    {
        return view('milih.calon.detail',[
            'detail'=>dataketua::where('ketua_id',$ketua->id)->get(),
            'ketua'=>$ketua
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ketua  $ketua
     * @return \Illuminate\Http\Response
     */
    public function edit(ketua $ketua)
    {
        $data=dataketua::where('ketua_id',$ketua->id)->first();
        if($data){
        return view('milih.calon.edit',[
            'detail'=>$data,
            'ketua'=>$ketua,
            'voting'=>vote::all(),
            'kelas'=>kelas::all(),
            'kab'=>Regency::all()
        ]);
        }
        else{
            return redirect(route('dataketua.create'))->with('warning','Error must fill data ketua value');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateketuaRequest  $request
     * @param  \App\Models\ketua  $ketua
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateketuaRequest $request, ketua $ketua)
    {
        $ketuarule=[
            'pemilihan_id'=>'required',
            'img'=>'image|file|mimes:png,jpg,svg'
        ];
        $datarule=[
            'kelas'=>'required',
            'tempatlahir'=>'required',
            'dob'=>'required|date',
            'pengalaman'=>'required',
            'ig'=>'required'
        ];
        if($request->nama!=$ketua->nama)
        {
            $ketuarule['nama']='required|unique:ketuas|min:5';
        }
        if($request->panggilan!=$ketua->panggilan)
        {
            $ketuarule['panggilan']='required|unique:ketuas|min:4';
        }
        if ($request->file('img')) 
        {
            if($request->oldImg){
                Storage::delete($request->oldImg);
            }
            $valrule['img']=$request->file('img')->store('app-image');
        }
        $valketua=$request->validate($ketuarule);
        $valdata=$request->validate($datarule);
        $valdata['ketua_id']=$ketua->id;
        ketua::where('id',$ketua->id)->update($valketua);
        dataketua::where('ketua_id',$ketua->id)->update($valdata);
        return redirect(route('ketua.index'))->with('success','Berhasil mengupdate data '.$ketua->nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ketua  $ketua
     * @return \Illuminate\Http\Response
     */
    public function destroy(ketua $ketua)
    {
        if($ketua->img){
            Storage::delete($ketua->img);
        }
        $dataketua=dataketua::where('ketua_id',$ketua->id)->get();
        ketua::destroy($ketua->id);
        dataketua::destroy($dataketua);
        return redirect(route('ketua.index'))->with('success','Data ketua berhasil dihapus');
    }
}
