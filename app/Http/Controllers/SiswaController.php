<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\status;
use App\Models\Regency;
use App\Models\Angkatan;
use App\Mail\PendataanMail;
use Illuminate\Support\Str;
use App\Models\detailstatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\ReviewPendataanMail;
use Illuminate\Support\Facades\Mail;
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
            'datum'=>siswa::where('user_id',auth()->user()->id)->get(),
            'admin'=>siswa::all(),
            'status'=>status::all(),
            'cs1'=>siswa::where('status','1')->count(),
            'cs2'=>siswa::where('status','2')->count(),
            'cs3'=>siswa::where('status','3')->count(),
            'cs4'=>siswa::where('status','4')->count(),
            'mostclass'=>siswa::select('kelas')->selectRaw('COUNT(*) AS count')->groupBy('kelas')->orderByDesc('count')->first(),
            'mostcity'=>siswa::select('domisili')->selectRaw('COUNT(*) AS count')->groupBy('domisili')->orderByDesc('count')->first(),
            'mostuni'=>siswa::select('instansi')->selectRaw('COUNT(*) AS count')->groupBy('instansi')->orderByDesc('count')->first(),
            'jmldata'=>siswa::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role == 'User')
        {
            $data=siswa::where('user_id',auth()->user()->id)->first();
            if($data)
            {
                return back()->with('info','Anda sudah melakukan pendataan, silahkan edit data anda jika ada kesalahan');
            }
        }
        return view('services.pendataan.create',[
            'kelas'=>kelas::all(),
            'kab'=>Regency::all(),
            'angkatan'=>Angkatan::all(),
            'status'=>status::all(),
            'instansi'=>detailstatus::all(),
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
        $validated=$request->validated();
        if ($request->instansi==null&&(in_array($request->status,[3,5]))) {
            $validated['instansi']='Gapyear/Menikah';
        }
        if($validated['instansi']){
            $get=detailstatus::where('id',$validated['instansi'])->first();
            $validated['instansi']=$get->nama;
        }
        if($request->instansi==null&&$request->instansi_manual){
            $validated['instansi']=$validated['instansi_manual'];
        }
        if(auth()->user()){
            if(auth()->user()->role == 'User'){
                $cek=siswa::where('user_id',auth()->user()->id)->first();
                if($cek){
                    return back()->with('info','Anda sudah melakukan pendataan, silahkan edit data anda jika ada kesalahan');
                }else{
                    $validated['user_id']=auth()->user()->id;
                }
            }else{
                $validated['user_id']=auth()->user()->id;
            }
        }else{
            $validated['user_id']=null;
        }
        $validated['url']=Str::uuid();
        $validated['ip']=$request->ip();
        $validated['review']=0;
        $validated['message']="Belum ada pesan";
        $store=Siswa::create($validated);
        Mail::to($store->email)->queue(new PendataanMail($store));
        if ($store){
            return redirect(route('pendataan.index'))->with('success','Terimakasih Telah Mengisi Pendataan, salinan pendataan telah dikirim ke email anda');
        } else {
           return redirect(route('pendataan.index'))->with('toast_error','Terjadi Kesalahan Ulangi Pengisian Form Anda');
        }
    }

    public function storeAPI(StoresiswaRequest $request)
    {
        $validated=$request->validated();
        if ($request->instansi==null&&(in_array($request->status,[3,5]))) {
            $validated['instansi']='Gapyear/Menikah';
        }
        if($validated['instansi']!='Gapyear/Menikah'){
            $get=detailstatus::where('id',$validated['instansi'])->first();
            $validated['instansi']=$get->nama;
        }
        if($request->instansi==null&&$request->instansi_manual){
            $validated['instansi']=$validated['instansi_manual'];
        }
        if(auth()->user()){
            $cek=siswa::where('user_id',auth()->user()->id)->first();
            if($cek){
                return back()->with('info','Anda sudah melakukan pendataan, silahkan edit data anda jika ada kesalahan');
            }else{
                $validated['user_id']=auth()->user()->id;
            }
        }else{
            $validated['user_id']=null;
        }
        $validated['url']=Str::uuid();
        $validated['ip']=$request->ip();
        $validated['review']=0;
        $validated['message']="Belum ada pesan";
        $store=Siswa::create($validated);
        Mail::to($store->email)->queue(new PendataanMail($store));
        if ($store){
            return response()->json('success',200);
        } else {
           return response()->json('error',500);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $siswa=siswa::where('url',$url)->first();
        if($siswa){
        return view('services.pendataan.view',[
            'data'=>$siswa,
        ]);
        }else{
            return redirect(route('pendataan.index'))->with('toast_error','Data Tidak Ditemukan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $siswa=Siswa::where('url',$url)->first();
        return view('services.pendataan.edit',[
            'data'=>$siswa,
            'kelas'=>kelas::all(),
            'kab'=>Regency::all(),
            'angkatan'=>Angkatan::all(),
            'status'=>status::all(),
            'instansi'=>detailstatus::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesiswaRequest  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesiswaRequest $request, $id)
    {
        $siswa=siswa::where('id',$id)->first();
        $validUpdate=$request->validate([
            'nama'=>'required',
            'email'=>'required|email:dns',
            'kelas'=>'required',
            'status'=>'required',
            'instansi'=>Rule::requiredIf($request->status == [1,2,4]),
            'instansi_manual'=>Rule::requiredIf($request->status == [1,2,4]),
            'detail_status'=>'required',
            'domisili'=>'required',
            'teman_smasa'=>'required',
            'banyak_teman'=>'requiredIf:teman_smasa,ada',
            'angkatan_id'=>'required',
            'nomor'=>'required|digits_between:10,13',
            'review'=>'required|digits_between:0,2',
            'message'=>Rule::requiredIf($request->review == 2),
        ]);
        $validUpdate['pengajuan']=1;
        $upload=siswa::where('id',$siswa->id)->update($validUpdate);
        Mail::to($siswa->email)->queue(new ReviewPendataanMail($siswa));
        if ($upload){
            return redirect(route('pendataan.index'))->with('success','Data Berhasil Diupdate');
        } else {
            return redirect(route('pendataan.index'))->with('toast_error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        siswa::where('id',$id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Data Berhasil Dihapus'
        ]);
    }

    public function cekDetail(Request $req)
    {
       $detail=detailstatus::where('id_status',$req->id_status)->get();
        return response()->json($detail,200);
    }
    public function publicform()
    {
        return view('public.form-public',[
            'kelas'=>kelas::all(),
            'kab'=>Regency::all(),
            'angkatan'=>Angkatan::all(),
            'status'=>status::all(),
            'instansi'=>detailstatus::all(),
        ]);
    }
    public function cekpendataan($url)
    {
        $siswa=siswa::where('url',$url)->first();
        return view('services.pendataan.cek',[
            'datum'=>$siswa
        ]);
    }
}
