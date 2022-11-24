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
use Illuminate\Validation\Rule;
use App\Http\Requests\StoresiswaRequest;
use App\Http\Requests\UpdatesiswaRequest;
use Illuminate\Support\Facades\Redirect;

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
        return view('services.pendataan.create',[
            'kelas'=>kelas::all(),
            'kab'=>Regency::all(),
            'angkatan'=>Angkatan::all(),
            'status'=>status::all(),
            'instansi'=>detailstatus::all(),
            // 'detail_status'=>tempatstatus::all(),
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
            'email'=>'required|unique:siswas|email:dns',
            'kelas'=>'required',
            'status'=>'required',
            'instansi'=>Rule::requiredIf($request->status == [1,2,4]),
            'instansi_manual'=>Rule::requiredIf($request->status == [1,2,4]),
            'detail_status'=>'required',
            'domisili'=>'required',
            'teman_smasa'=>'required',
            'angkatan_id'=>'required',
            'nomor'=>'required|digits_between:10,13|unique:siswas'
        ]);
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
        $validated['user_id']=auth()->user()->id;
        $validated['review']=0;
        $validated['message']="Belum ada pesan";
        $store=Siswa::create($validated);
        if ($store){
            return redirect(route('pendataan.index'))->with('success','Terimakasih Telah Mengisi Pendataan, data anda akan kami verifikasi');
        } else {
           return redirect(route('pendataan.index'))->with('toast_error','Terjadi Kesalahan Ulangi Pengisian Form Anda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa=siswa::where('id',$id)->first();
        return view('services.pendataan.view',[
            'data'=>$siswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa=Siswa::where('id',$id)->first();
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
            'angkatan_id'=>'required',
            'nomor'=>'required|digits_between:10,13',
            'review'=>'required|digits_between:0,2',
            'message'=>Rule::requiredIf($request->review == 2),
        ]);
        $upload=siswa::where('id',$siswa->id)->update($validUpdate);
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
        return response()->json([
        'status'=>200,
        'detail'=>$detail
       ]);
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
}
