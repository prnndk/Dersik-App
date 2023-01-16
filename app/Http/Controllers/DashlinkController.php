<?php

namespace App\Http\Controllers;

use App\Models\dashlink;
use App\Http\Requests\StoredashlinkRequest;
use App\Http\Requests\UpdatedashlinkRequest;
use Illuminate\Http\Request;

class DashlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashlinks.index',[
            'data'=>dashlink::all(),
            'btn_color'=>[
                'Primary',
                'Secondary',
                'Success',
                'Danger',
                'Warning',
                'Info',
                'Light',
                'Dark',
                'Link'
            ],
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
     * @param  \App\Http\Requests\StoredashlinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredashlinkRequest $request)
    {
        $validated=$request->validated();
        if($validated)
        {
            dashlink::create($validated);
            return response()->json([
                'status'=>200,
                'success'=>'Data Added successfully.'
            ]);
        }

    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dashlink  $dashlink
     * @return \Illuminate\Http\Response
     */
    public function show(dashlink $dashlink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dashlink  $dashlink
     * @return \Illuminate\Http\Response
     */
    public function edit(dashlink $dashlink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedashlinkRequest  $request
     * @param  \App\Models\dashlink  $dashlink
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedashlinkRequest $request, dashlink $dashlink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dashlink  $dashlink
     * @return \Illuminate\Http\Response
     */
    public function destroy(dashlink $dashlink)
    {
        //
    }
    public function apiLink(Request $request)
    {
        $data=dashlink::where('id',$request->id)->first();
        if($data)
        {
            return response()->json([
                'status'=>200,
                'data'=>$data,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'data'=>'Data Not Found',
            ]);
        }
    }
}
