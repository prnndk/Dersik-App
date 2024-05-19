<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisPromRequest;
use App\Models\Informasi;
use App\Models\kelas;
use App\Models\RegisProm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisPromController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('dashboard.form.index', [
            'index' => RegisProm::latest()->paginate(10)->withQueryString(),
            'datauser' => RegisProm::where('user_id', auth()->user()->id)->first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = RegisProm::where('user_id', auth()->user()->id)->first();
        if (!$data || auth()->user()->role == 'admin') {
            return view('dashboard.form.create', [
                'kelas' => kelas::all(),
            ]);
        } else {
            return redirect('/dashboard/formprom')->with('toast_error', 'Anda Sudah Pernah Melakukan Pendaftaran');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegisPromRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['qr_code'] = Str::random(32);
        DB::beginTransaction();
        try {
            RegisProm::create($validatedData);
        } catch (\Exception $e) {
            DB::rollback();
            $this->notifyBot($e->getMessage());

            return redirect(route('formprom.create'))->with('toast_error', 'Terjadi Kesalahan Saat Insert Data!');
        }
        DB::commit();
        $this->notifyBot('Registrasi Prom baru telah dibuat oleh user '.auth()->user()->name);

        return redirect(route('formprom.index'))->with('success', 'Berhasil Melakukan Registrasi');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RegisProm $RegisProm
     *
     * @return \Illuminate\Http\Response
     */
    public function show(RegisProm $regis_prom)
    {
        return view('dashboard.form.show', [
            'detail' => $regis_prom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisProm $regisProm)
    {
        return view('dashboard.form.edit', [
            'data' => $regisProm,
            'kelas' => kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateRegisPromRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegisProm $regisProm)
    {
        $rules = [
            'user_id' => 'required|unique:regis_proms',
            'kelas_id' => 'required',
            'kesediaan' => 'required',
            'no_hp' => 'required|digits_between:10,13',
        ];
        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        DB::beginTransaction();
        try {
            $regisProm->update($validatedData);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notifyBot($e->getMessage());
            throw $e;
        }
        DB::commit();

        return redirect('/dashboard/form')->with('success', 'Data Has Been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RegisProm $regisProm
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisProm $regis_prom)
    {
        $regis_prom->delete();

        return redirect('/dashboard/formprom')->with('success', 'Data has been deleted');
    }

    public function infobayar()
    {
        return view('dashboard.infobayar', [
            'userdata' => User::all(),
            'dataform' => RegisProm::all(),
            'userbayar' => RegisProm::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function undangan()
    {
        return view('dashboard.undangan', [
            'undangan' => RegisProm::where('user_id', auth()->user()->id)->first(),
            'info' => Informasi::all(),
        ]);
    }

    public function scan()
    {
        return view('dashboard.scan');
    }

    public function verifikasi(Request $request)
    {
        $validated = $request->validate([
            'qr_code' => 'required|string',
        ]);
        $prom_data = RegisProm::where('qr_code', $validated['qr_code'])->first();
        if (!$prom_data) {
            return response()->json([
                'success' => false,
                'message' => 'Data Cannot be found',
            ], 404);
        }
        if (!$prom_data->statusbayar == 'Belum Lunas') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran Belum Lunas',
            ]);
        }
    }
}
