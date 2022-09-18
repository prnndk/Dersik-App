<?php

namespace App\Http\Controllers;

use App\Models\tempatstatus;
use App\Http\Requests\StoretempatstatusRequest;
use App\Http\Requests\UpdatetempatstatusRequest;
use App\Models\detailstatus;

class TempatstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.status.detail.index',[
            'detail'=>tempatstatus::all(),
            'statusd'=>detailstatus::all()
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
     * @param  \App\Http\Requests\StoretempatstatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretempatstatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tempatstatus  $tempatstatus
     * @return \Illuminate\Http\Response
     */
    public function show(tempatstatus $tempatstatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tempatstatus  $tempatstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(tempatstatus $tempatstatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetempatstatusRequest  $request
     * @param  \App\Models\tempatstatus  $tempatstatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetempatstatusRequest $request, tempatstatus $tempatstatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tempatstatus  $tempatstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(tempatstatus $tempatstatus)
    {
        //
    }
}
