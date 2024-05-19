<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreketuaRequest;
use App\Http\Requests\UpdateketuaRequest;
use App\Models\dataketua;
use App\Models\kelas;
use App\Models\ketua;
use App\Models\Regency;
use App\Models\vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('milih.calon.index', [
            'info' => dataketua::all(),
            'calon' => ketua::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('milih.calon.tambah', [
            'voting' => vote::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreketuaRequest $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|unique:ketuas|min:5',
            'panggilan' => 'required|unique:ketuas|min:4',
            'pemilihan_id' => 'required',
            'img' => 'image|file|mimes:png,jpg,svg',
        ]);
        if ($request->file('img')) {
            $validatedData['img'] = $request->file('img')->store('public/app-image');
        }
        $validatedData['suara'] = 0;
        $create = ketua::create($validatedData);
        if ($create) {
            return redirect('/dashboard/ketua')->with('success', 'Calon ketua berhasil ditambahkan!');
        } else {
            return redirect('/dashboard/ketua')->with('error', 'Gagal menambahkan calon ketua');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ketua $ketua)
    {
        return view('milih.calon.detail', [
            'detail' => dataketua::where('ketua_id', $ketua->id)->get(),
            'ketua' => $ketua,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ketua $ketua)
    {
        $data = dataketua::where('ketua_id', $ketua->id)->first();
        if ($data) {
            return view('milih.calon.edit', [
                'detail' => $data,
                'ketua' => $ketua,
                'voting' => vote::all(),
                'kelas' => kelas::all(),
                'kab' => Regency::all(),
            ]);
        } else {
            return redirect(route('dataketua.create'))->with('warning', 'Error must fill data ketua value');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateketuaRequest $request, ketua $ketua)
    {
        $ketuarule = [
            'pemilihan_id' => 'required',
            'img' => 'image|file|mimes:png,jpg,svg|max:2048',
        ];
        $datarule = [
            'kelas' => 'required',
            'tempatlahir' => 'required',
            'dob' => 'required|date',
            'pengalaman' => 'required',
            'ig' => 'required',
        ];
        if ($request->nama != $ketua->nama) {
            $ketuarule['nama'] = 'required|unique:ketuas|min:5';
        }
        if ($request->panggilan != $ketua->panggilan) {
            $ketuarule['panggilan'] = 'required|unique:ketuas|min:4';
        }
        $valketua = $request->validate($ketuarule);
        if ($request->file('img')) {
            if ($request->oldImg) {
                Storage::delete($request->oldImg);
            }
            $valketua['img'] = $request->file('img')->store('app-image');
        }
        $valdata = $request->validate($datarule);
        $valdata['ketua_id'] = $ketua->id;
        DB::beginTransaction();
        try {
            ketua::where('id', $ketua->id)->update($valketua);
            dataketua::where('ketua_id', $ketua->id)->update($valdata);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect(route('ketua.index'))->with('toast_error', 'Gagal mengupdate data '.$ketua->nama);
        }
        DB::commit();

        return redirect(route('ketua.index'))->with('success', 'Berhasil mengupdate data '.$ketua->nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ketua $ketua)
    {
        if ($ketua->img) {
            Storage::delete($ketua->img);
        }
        dataketua::where('ketua_id', $ketua->id)->first()->delete();
        $ketua->delete();

        return redirect(route('ketua.index'))->with('success', 'Data ketua berhasil dihapus');
    }
}
