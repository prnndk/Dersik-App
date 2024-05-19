<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestatusRequest;
use App\Http\Requests\UpdatestatusRequest;
use App\Models\status;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.status.index', [
            'status' => status::all(),
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
     * @return \Illuminate\Http\Response
     */
    public function store(StorestatusRequest $request)
    {
        $validate = $request->validate(['nama' => 'required|unique:statuses']);
        $setor = status::create($validate);
        if ($setor) {
            return redirect(route('status.index'))->with('success', 'Status Baru telah Ditambahkan');
        } else {
            return redirect(route('status.index'))->with('error', 'Terjadi kesalahan saat input');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(status $status)
    {
        return response()->json([
           'status' => 200,
           'data' => $status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(status $status)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestatusRequest $request, status $status)
    {
        $valup = $request->validate(
            ['nama' => 'required|unique:statuses']
        );
        DB::beginTransaction();
        try {
            $status->update($valup);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notifyBot($e);

            return redirect(route('status.index'))->with('toast_error', 'Terjadi Kesalahan');
        }
        DB::commit();

        return redirect(route('status.index'))->with('success', 'Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(status $status)
    {
        $status->delete();

        return redirect(route('status.index'))->with('success', 'Data Berhasil Dihapus');
    }
}
