<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Angkatan;
use App\Models\Informasi;
use App\Models\kateginfo;
use App\Models\Shortlink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.info.index', [
            'info' => Informasi::with(['kateginfo', 'angkat', 'user'])->latest()->get(),
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
            return redirect(route('informasi.index'))->with('warning', 'Anda Tidak Punya Akses untuk halaman ini');
        }

        return view('services.info.create', [
            'kategori' => kateginfo::all(),
            'angkatan' => Angkatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInformasiRequest $request)
    {
        $validateData = $request->validate([
           'judul' => 'required|min:5',
            'kategori_informasi' => 'required',
            'angkatan' => 'required',
            'img' => 'required|file|image|mimes:png,jpg,svg|max:2048',
            'body' => 'required',
            'informasi_type' => 'required|numeric',
            'shortlink' => 'required|boolean',
            'shortened' => 'required_if:shortlink,true|string|alpha_dash|min:3',
        ]);

        $validateData['slug'] = Str::slug($validateData['judul']);
        $validateData['active'] = true;

        $validateData['oleh'] = auth()->user()->id;
        if ($request->file('img')) {
            $validateData['img'] = $request->file('img')->store('app-image');
        }
        DB::beginTransaction();
        try {
            if ($validateData['shortlink']) {
                Shortlink::create([
                    'shortened' => $validateData['shortened'],
                    'original' => route('informasi.show', $validateData['slug']),
                    'oleh' => auth()->user()->id,
                    'active' => true,
                ]);
            }
            Informasi::create($validateData);
        } catch (\Throwable $th) {
            Storage::delete($validateData['img']);
            DB::rollBack();
            throw $th;
        }
        DB::commit();
        $this->notifyBot('Informasi baru telah dibuat oleh '.auth()->user()->name);

        return redirect(route('informasi.index'))->with('success', 'Berhasil Menambahkan Informasi Baru');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Informasi $informasi)
    {
        return $informasi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Informasi $informasi)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInformasiRequest $request, Informasi $informasi)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informasi $informasi)
    {
    }
}
