<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\vote;
use App\Models\kelas;
use App\Models\ketua;
use App\Models\pemilih;
use App\Models\dataketua;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorepemilihRequest;
use App\Http\Requests\UpdatepemilihRequest;

class PemilihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('milih.pemilih.index',[
            'user'=>user::all(),
            'pemilih'=>pemilih::all(),
            'vote'=>vote::all(),
            'kelas'=>kelas::all(),
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
     * @param  \App\Http\Requests\StorepemilihRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepemilihRequest $request)
    {
        $validated=$request->validate([
            'user_id'=>'required',
            'vote_id'=>'required'
        ]);
        $validated['token']=Str::random(7);
        $validated['status_pilih']=0;
        $add=pemilih::create($validated);
        if ($add)
        {
        return redirect(route('pemilih.index'))->with('success','Pemilih Berhasil Ditambahkan');
        }else{
        return redirect(route('pemilih.index'))->with('warning','Terjadi Kegagalan');
        }

    }
    public function allgenerate(Request $request)
    {
        $user=User::all();
        foreach($user as $ser)
        {
            $data=[
                'token'=>Str::random(7),
                'user_id'=>$ser->id,
                'status_pilih'=>0,
                'vote_id'=>$request->vote_id,
            ];
            pemilih::create($data);
        }
        return redirect(route('pemilih.index'))->with('success','Succesfully generate token to all user');
    }
    public function angkatgenerate(Request $req)
    {
        $user=User::where('kelas_id',$req->kelas_id)->get();
        foreach ($user as $usr) {
            $data=[
                'token'=>Str::random(7),
                'user_id'=>$usr->id,
                'status_pilih'=>0,
                'vote_id'=>$req->vote_id,
            ];
            pemilih::create($data);
        }
        return redirect(route('pemilih.index'))->with('success','Succesfully generate token to all user in that class');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function show(pemilih $pemilih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function edit(pemilih $pemilih)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepemilihRequest  $request
     * @param  \App\Models\pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepemilihRequest $request, pemilih $pemilih)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemilih  $pemilih
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemilih $pemilih)
    {
        pemilih::destroy($pemilih->id);
        return redirect(route('pemilih.index'))->with('toast_success','Data Pemilih Berhasil Dihapus');
    }
    public function homevote()
    {       
        $time=Carbon::now();
        $vote=vote::where('mulai_coblos','<=',$time)->get();
        return view('milih.vote.home',[
            'vote'=>$vote,
        ]);
    }
    public function lihatHasil(vote $vote)
    {
            $time=Carbon::now();
            $mulai=$vote->mulai_coblos;
            $voter=pemilih::where('vote_id',$vote->id)->count();
            if($time>=$mulai){
                $data=ketua::where('pemilihan_id',$vote->id)->get();
                return view('milih.qc',['data'=>$data,'vote'=>$vote,'voter'=>$voter]);
            }
            return redirect(route('pilihHome'))->with('toast_error','Pemilihan belum dimulai');
    }
    public function cektoken(Request $request)
    {
        $token = $request->token;
        $cek = pemilih::where('token', $token)->first();
        $voted = pemilih::where(['token' => $token, 'status_pilih' => 1])->first();
        if (!$cek) {
            return redirect(route('vote'))->with('warning', 'Token yang anda masukkan salah!');
        } else {
            $pemilihan = vote::where('id', $cek->vote_id)->first();
            if ($voted) {
                return redirect(route('vote'))->with('toast_error','Token Anda Sudah Digunakan');
            } else {
                if (Carbon::now() >$pemilihan->akhir_coblos) {
                return redirect(route('vote'))->with('info','Pemilihan telah Selesai');
                }elseif(Carbon::now()<$pemilihan->mulai_coblos){
                return redirect(route('vote'))->with('info','Pemilihan Belum Dimulai');
                }else{
                    $request->session()->put('token', $token);
                    return redirect(route('pilihHome', $cek->vote->link))->with('toast_success', 'Token Anda Terdaftar');
                }
                }
            }
        }
    public function milih(vote $vote)
    {
        $tokencek=pemilih::where('token',session()->get('token'))->first();
        if (!$tokencek) {
            return redirect(route('vote'))->with('toast_error','Login dulu dengan Token');
        }else{
            return view('milih.vote.pilih',[
            'ketua'=>ketua::where('pemilihan_id',$vote->id)->get(),
                'token'=>$tokencek,
                'pemilihan'=>$vote
            ]);
        }
    }
    public function logouttoken(Request $req)
    {
        $voted=pemilih::where('token',session()->get('token'))->first();
        if(!$voted){
            return redirect(route('vote'))->with('toast_error','Anda tidak mempunyai token aktif !');
        }else{
            if ($voted->status_pilih==0) {
                $req->session()->forget('token');
                return redirect(route('vote'))->with('warning','Berhasil Logout Tetapi Belum Memilih');
            }else {
                $req->session()->forget('token');
                return redirect(route('vote'))->with('success','Terimakasih Anda telah Berhasil memilih 👋');
            }
        }

    }
    public function simpan($idketua,Request $request)
    {
        $getToken=pemilih::where('token',session()->get('token'))->first();
        if(!$getToken){
            return redirect(route('vote'))->with('toast_error','Anda Belum Memasukkan Token');
        }else{
            $ketua=ketua::where('id',$idketua)->first();
            $saveVote=ketua::where('id',$idketua)->update([
                'suara'=>$ketua->suara+1
            ]);
            pemilih::where('token',$getToken->token)->update([
                'status_pilih'=>1
            ]);
            if ($saveVote){
                return redirect(route('logoutVote'));
            }
        }
    }
    public function fetchcalon(Request $request)
    {
    $dataCalon=dataketua::where('ketua_id',$request->id)->with(['kelases','kota','ketua'])->first();
    if($dataCalon){
    return response()->json([
        'status'=>200,
       'calon'=>$dataCalon,
    ]);
    }
    else{
        return response()->json([
            'status'=>404,
           'msg'=>'Data Not found'
        ]);
    }
    }
    public function usertoken()
    {
        $userId=auth()->user()->id;
        $token=pemilih::where('user_id',$userId)->get();
        return view('milih.usertoken',[
        'userToken'=>$token
        ]);    
    }
}

