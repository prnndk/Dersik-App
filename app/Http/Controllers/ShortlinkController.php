<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortlinkRequest;
use App\Http\Requests\UpdateShortlinkRequest;
use App\Models\Shortlink;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortlinkRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($shortened)
    {
        $shortlink = Shortlink::whereRaw('BINARY shortened =?', [$shortened])->where('active', true)->firstOrFail();
        $shortlink->hit++;
        $shortlink->save();

        return redirect()->away($shortlink->original);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Shortlink $shortlink)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShortlinkRequest $request, Shortlink $shortlink)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shortlink $shortlink)
    {
    }
}
