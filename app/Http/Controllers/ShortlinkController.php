<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortlinkRequest;
use App\Http\Requests\UpdateShortlinkRequest;
use App\Models\Shortlink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
    public function create(): View
    {
        return view('services.shortlink',[
            'links' => Shortlink::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortlinkRequest $request) : JsonResponse
    {
        $validatedRequest = $request->validate([
            'original' => 'required|url',
            'shortened' => 'required|string|unique:shortlinks,shortened',
            'oleh'=>'required|exists:users,id',
        ]);
        $validatedRequest['active'] = true;
        DB::beginTransaction();
        try {
            Shortlink::create($validatedRequest);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat shortlink',
            ],500);
        }
        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat shortlink',
        ]);
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
    public function cekLink(Request $request){
        $shortened = $request->shortened;
        $request->validate([
                'shortened' => 'required|string',
            ]);
        $shortlink = Shortlink::whereRaw('BINARY shortened =?', [$shortened])->first();
        if ($shortlink) {
            return response()->json([
                'success' => false,
                'message' => 'String tersebut sudah terdaftar',
            ],500);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'String tersebut belum terdaftar',
            ]);
        }
    }
}
