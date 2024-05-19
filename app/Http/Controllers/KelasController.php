<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekelasRequest;
use App\Http\Requests\UpdatekelasRequest;
use App\Models\Angkatan;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.kelas.index', [
            'kelas' => kelas::all(),
            'currentTime' => getdate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role == 'User') {
            return redirect(route('kelas.index'))->with('warning', 'Role anda tidak bisa menambahkan kelas');
        } else {
            return view('data.kelas.buat', [
                'angkatan' => Angkatan::all(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorekelasRequest $request)
    {
        $ValidatedData = $request->validate([
            'kelas' => 'required|string|max:100',
            'id_angkatan' => 'required|exists:angkatans,id',
            'nama' => 'required|unique:kelas|max:100',
            'instagram' => 'required|unique:kelas',
            'jumlah' => 'digits:2|required',
            'fotbar' => 'image|file|mimes:png,jpg,svg|max:2048',
        ]);
        if ($request->file('fotbar')) {
            $ValidatedData['fotbar'] = $request->file('fotbar')->store('app-image');
        }
        $make = kelas::create($ValidatedData);
        if ($make) {
            return redirect('/dashboard/kelas')->with('success', 'Data Kelas Berhasil Ditambahkan!');
        } else {
            return redirect('/dashboard/kelas')->with('error', 'Gagal menambahkan data kelas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\kelas $kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('data.kelas.detail', [
            'kelas' => kelas::where('id', $id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\kelas $kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role == 'User') {
            return redirect(route('kelas.index'))->with('warning', 'Role anda tidak dapat melakukan edit data');
        }
        $kls = kelas::where('id', $id)->first();

        return view('data.kelas.edit', [
            'kelas' => $kls,
            'angkatan' => angkatan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\kelas $kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekelasRequest $request, $id)
    {
        $kelas = kelas::where('id', $id)->first();
        $valrule = [
            'kelas' => 'required',
            'id_angkatan' => 'required',
            'jumlah' => 'digits:2|required',
            'fotbar' => 'image|file|mimes:png,jpg,svg',
        ];
        if ($request->nama != $kelas->nama) {
            $valrule['nama'] = 'required|unique:kelas';
        }
        if ($request->instagram != $kelas->instagram) {
            $valrule['instagram'] = 'required|unique:kelas';
        }
        $ValidatedData = $request->validate($valrule);
        if ($request->file('fotbar')) {
            if ($request->oldFotbar) {
                Storage::delete($request->oldFotbar);
            }
            $ValidatedData['fotbar'] = $request->file('fotbar')->store('app-image');
        }
        $make = kelas::where('id', $kelas->id)->update($ValidatedData);
        if ($make) {
            return redirect(route('kelas.index'))->with('success', 'Data Kelas Berhasil Diupdate!');
        } else {
            return redirect('/dashboard/kelas')->with('toast_error', 'Gagal menambahkan data kelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\kelas $kelas
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = kelas::where('id', $id)->firstOrFail();
        $this->notifyBot($data->kelas.' Kelas Dihapuskan');
        if ($data->fotbar) {
            Storage::delete($data->fotbar);
        }
        $data->delete();

        return redirect(route('kelas.index'))->with('success', 'Data Kelas Berhasil Dihapus');
    }

    public function getByAngkatan(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:angkatans,id',
        ]);
        $angkatan = $request->id;
        $kelas = kelas::where('id_angkatan', $angkatan)->get();

        return response()->json([
            'success' => true,
            'kelas' => $kelas,
        ], 200);
    }
}
