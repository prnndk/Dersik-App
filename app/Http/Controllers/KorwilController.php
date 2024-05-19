<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKorwilRequest;
use App\Models\korwil;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;

class KorwilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('dashboard.datakorwil.index', [
            'korwil' => korwil::all(),
            'city' => Regency::all(),
            'user' => User::all(),
            'grouped' => korwil::orderBy('kota_id')->get()->groupBy(function ($data) {
                return $data->kota->name;
            }),
        ]);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Exception
     */
    public function store(StoreKorwilRequest $request)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            korwil::create($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notifyBot('Gagal melakukan penambahan data korwil, \n error: '.$e->getMessage());

            return redirect(route('korwil.index'))->with('error', 'Gagal melakukan penambahan data korwil');
        }
        DB::commit();

        return redirect(route('korwil.index'))->with('success', 'Data Korwil Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
