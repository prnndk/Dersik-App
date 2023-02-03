<?php

namespace App\Http\Controllers;

use App\Models\Sidebar;
use App\Http\Requests\StoreSidebarRequest;
use App\Http\Requests\UpdateSidebarRequest;

class SidebarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSidebarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSidebarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function show(Sidebar $sidebar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function edit(Sidebar $sidebar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSidebarRequest  $request
     * @param  \App\Models\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSidebarRequest $request, Sidebar $sidebar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sidebar  $sidebar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sidebar $sidebar)
    {
        //
    }
}
