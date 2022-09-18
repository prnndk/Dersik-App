<?php

namespace App\Http\Controllers;

use App\Models\status;
use App\Http\Requests\StorestatusRequest;
use App\Http\Requests\UpdatestatusRequest;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.status.index',[
            'status'=>status::all(),
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
     * @param  \App\Http\Requests\StorestatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorestatusRequest $request)
    {
        $validate=$request->validate(['nama'=>'required|unique:statuses']);
        $setor=status::create($validate);
        if ($setor) {
            return redirect(route('status.index'))->with('success','Status Baru telah Ditambahkan');
        } else {
            return redirect(route('status.index'))->with('error','Terjadi kesalahan saat input');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(status $status)
    {
        return response()->json([
           'status'=>200,
           'data'=>$status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestatusRequest  $request
     * @param  \App\Models\status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestatusRequest $request, status $status)
    {
        $valup=$request->validate(
            ['nama'=>'required|unique:statuses']
        );
        $update=status::where('id',$status->id)->update($valup);
        if ($update) {
            return redirect(route('status.index'))->with('success','Data Berhasil Di Update');
        } else {
            return redirect(route('status.index'))->with('error','Terjadi Kesalahan');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(status $status)
    {
        status::destroy($status->id);
        return redirect(route('status.index'))->with('success','Data Berhasil Dihapus');
    }
}
