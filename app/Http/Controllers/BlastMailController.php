<?php

namespace App\Http\Controllers;

use App\Models\BlastMail;
use App\Http\Requests\StoreBlastMailRequest;
use App\Http\Requests\UpdateBlastMailRequest;

class BlastMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.blastemail',[

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
     * @param  \App\Http\Requests\StoreBlastMailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlastMailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlastMail  $blastMail
     * @return \Illuminate\Http\Response
     */
    public function show(BlastMail $blastMail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlastMail  $blastMail
     * @return \Illuminate\Http\Response
     */
    public function edit(BlastMail $blastMail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlastMailRequest  $request
     * @param  \App\Models\BlastMail  $blastMail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlastMailRequest $request, BlastMail $blastMail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlastMail  $blastMail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlastMail $blastMail)
    {
        //
    }
}
