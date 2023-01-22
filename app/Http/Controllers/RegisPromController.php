<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\Informasi;
use App\Models\RegisProm;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRegisPromRequest;
use App\Http\Requests\UpdateRegisPromRequest;

class RegisPromController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.form.index',[
            'index'=>RegisProm::latest()->paginate(10)->withQueryString(),
            'datauser'=>RegisProm::where('user_id',auth()->user()->id)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.form.create',[
            'kelas'=> kelas::all(),
            'user'=>RegisProm::where('user_id',auth()->user()->id)->get(),

        ]);
        if(RegisProm::where(['user_id', '=', auth()->user()->id])){
            return redirect('/dashboard/formprom')->with('error','Anda telah mengisi form ini!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input=$request->all();
        // $regis=RegisProm::create($input);
        $validatedData= $request->validate([
            'nama'=>'required|unique:regis_proms',
            'email'=>'required|unique:regis_proms|email:dns',
            'kelas_id'=>'required',
            'kesediaan'=>'required',
            'kedinasan'=>'required',
            'tanggal'=>'date|nullable|required_if:kedinasan,==,Ikut',
            'no_hp'=>'required|digits_between:10,13|unique:regis_proms',
        ]);
        $validatedData['user_id']=auth()->user()->id;
        $validatedData['qr_code']=Str::random(32);
        $input=RegisProm::create($validatedData);
        if($input){
            return redirect('/dashboard/formprom')->with('success','Thanks For Registring in PROMNIGHT DERSIK 22!');
            }else{
            return redirect ('/dashboard/formprom')->with('error','Data Gagal disimpan');
            }
        // return $request;
        // $this->validate($request,[
        //     'nama'=>'required|unique:regis_proms',
        //     'email'=>'required|unique:regis_proms|email:dns',
        //     'kelas_id'=>'required',
        //     'kesediaan'=>'required',
        //     'kedinasan'=>'required',
        //     'tanggal'=>'date',
        //     'no_hp'=>'required|digits_between:10,13',
        // ]);
        // $setor=RegisProm::create([
        //     'kelas_id'=>$request->kelas_id,
        //     'nama'=>$request->nama,
        //     'email'=>$request->email,
        //     'kesediaan'=>$request->kesediaan,
        //     'kedinasan'=>$request->kedinasan,
        //     'tanggal'=>$request->tanggal,
        //     'no_hp'=>$request->no_hp,
        // ]);
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisProm  $RegisProm
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=RegisProm::where('id', $id)->first();
        dd($data);
        return view('dashboard.form.show',[
            'detail'=>$data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegisProm  $regisProm
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisProm $regisProm)
    {
        return view('dashboard.form.edit',[
            'data'=>$regisProm,
            'kelas'=> kelas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegisPromRequest  $request
     * @param  \App\Models\RegisProm  $regisProm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegisProm $regisProm)
    {
        $rules=[
            'user_id'=>'required|unique:regis_proms',
            'kelas_id'=>'required',
            'kesediaan'=>'required',
            'no_hp'=>'required|digits_between:10,13', 
        ];
        $validatedData=$request->validate($rules);
        $validatedData['user_id']=auth()->user()->id;
        RegisProm::where('id',$regisProm->id)->update($validatedData);
        return redirect ('/dashboard/form')->with('success','Data Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisProm  $regisProm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $regisProm=RegisProm::where('id',$id)->first();
        RegisProm::destroy($regisProm->id);
        return redirect ('/dashboard/formprom')->with('success','Data has been deleted');
    }
    public function infobayar()
    {
        return view('dashboard.infobayar',[
            'userdata'=>User::all(),
            'dataform'=>RegisProm::all(),
            'userbayar'=>RegisProm::where('user_id',auth()->user()->id)->get()
        ]);
    }
    public function undangan()
    {
        return view('dashboard.undangan',[
            'undangan'=>RegisProm::where('user_id',auth()->user()->id)->first(),
            'info'=>Informasi::all()
        ]);
    }
    public function scan()
    {
        return view('dashboard.scan');
    }
    public function verifikasi(Request $request)
    {
        $dataqr=RegisProm::where("qr_code",$request->qr_code)->first();
        $qrpendataan=siswa::where('url',$request->qr_code)->first();
       if(!$dataqr&&!$qrpendataan){
           return response()->json('Not Found',404);
       }else if($dataqr){
           return response()->json($dataqr,200);
       }else if($qrpendataan){
            return response()->json($qrpendataan,200);
       }else{
        return response()->json('Not Found',404);
       }
    }
}
