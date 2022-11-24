<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\Regency;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers;
use App\Imports\UserImport;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class dashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index',[
            'user'=>User::with(['kelas','Regency'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create',[
            'kelas'=>kelas::all(),
            'kab'=>Regency::all()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'name'=>'required|unique:users|min:5',
            'email'=>'required|unique:users|email:dns',
            'username'=>'required|unique:users|min:4',
            'kelas_id'=>'required',
            'tempatlahir'=>'required',
            'dob'=>'required|date',
            'role'=>'required',
            'password'=>'required|min:8'
        ]);
        $validated['password']= Hash::make($validated['password']);
        $validated['email_verified_at']=date('Y-m-d H:i:s');
        $setor=User::create($validated);
        if ($setor) {
            return redirect(route('userlist.index'))->with('success','User Berhasil Ditambahkan');
        }else {
            return redirect(route('userlist.index'))->with('error','Terjadi Kesalahan data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.user.detail',[
            'data'=>User::FindorFail($id),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.user.show',[
            'user'=>User::FindorFail($id),
            'kelas'=>kelas::all(),
            'kab'=>Regency::all()->sortBy('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user,$id)
    {
        $data=User::FindorFail($id);
        $upval=$request->validate([
            'kelas_id'=>'required',
            'tempatlahir'=>'required',
            'dob'=>'required|date',
            'role'=>'required',
            'password'=>'required|min:8'
        ]);
        if ($request->email != $data->email) {
            $upval['email']='required|unique:users|email:dns';
        }
        if ($request->username != $data->username) {
            $upval['username']='required|unique:users|min:4';
        }
        if  ($request->name != $data->name){
            $upval['name']='required|unique:users|min:5';
        }
        $upval['password']= Hash::make($upval['password']);
        $update=User::where('id',$data->id)->update($upval);
        if ($update) {
            return redirect(route('userlist.index'))->with('success','Data User Berhasil Di update');
        }else{
            return redirect(route('userlist.index'))->with('error','Data Gagal Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::where('id',$id)->get();
        User::destroy($user);
        return redirect (route('userlist.index'))->with('success','Data has been deleted');
    }
    public function exportuser()
    {
        return Excel::download(new UserExport,'UserData.xlsx');
    }
    public function importuser(Request $request)
    {
        Excel::import(new UserImport,$request->file('file')->store('temp'));
        return redirect(route('userlist.index'))->with('success','Berhasil Import Data!');
    }
}
