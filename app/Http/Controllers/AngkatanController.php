<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAngkatanRequest;
use App\Http\Requests\UpdateAngkatanRequest;
use App\Models\Angkatan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.angkatan.angkatan', [
            'angkatan' => Angkatan::all(),
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
            return redirect(route('angkatan.index'))->with('warning', 'Role anda tidak bisa menambahkan data');
        } else {
            return view('data.angkatan.new');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAngkatanRequest $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:angkatans|min:3',
            'email' => 'required|email:dns|unique:angkatans',
            'tahun' => 'required|digits:4|unique:angkatans',
            'ig' => 'required|unique:angkatans',
            'ketua' => 'unique:angkatans|min:5',
            'logo' => 'image|file|mimes:png,jpg,svg',
            'filosofi'=>'max:255'
        ]);
        if ($request->file('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('app-image');
        }
        $create = Angkatan::create($validated);
        if ($create) {
            return redirect('/dashboard/angkatan')->with('success', 'Data Angkatan berhasil ditambahkan!');
        } else {
            return redirect('/dashboard/angkatan')->with('warning', 'Gagal menambahkan data angkatan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Angkatan $angkatan)
    {
        return view('data.angkatan.detail', [
            'angkat' => $angkatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Angkatan $angkatan)
    {
        if (auth()->user()->role == 'User') {
            return redirect(route('angkatan.index'))->with('warning', 'Anda tidak punya akses untuk halaman ini');
        }

        return view('data.angkatan.edit', [
            'angkatan' => $angkatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAngkatanRequest $request, Angkatan $angkatan)
    {
        $validUpdate = [
            'logo' => 'image|file|mimes:png,jpg,svg|max:2048',
        ];
        if ($request->nama != $angkatan->nama) {
            $validUpdate['nama'] = 'required|unique:angkatans|min:3';
        }
        if ($request->email != $angkatan->email) {
            $validUpdate['email'] = 'required|email:dns|unique:angkatans';
        }
        if ($request->tahun != $angkatan->tahun) {
            $validUpdate['tahun'] = 'required|digits:4|unique:angkatans';
        }
        if ($request->ig != $angkatan->ig) {
            $validUpdate['ig'] = 'required|unique:angkatans';
        }
        if ($request->ketua != $angkatan->ketua) {
            $validUpdate['ketua'] = 'unique:angkatans|min:5';
        }
        if ($request->file('logo')) {
            if ($request->oldLogo) {
                Storage::delete($request->oldLogo);
            }
        }
        $path = Storage::putFileAs('app-image', $request->file('logo'), Str::kebab($request->nama));
        $validated = $request->validate($validUpdate);
        $validated['logo'] = $path;
        Angkatan::where('id', $angkatan->id)->update($validated);

        return redirect(route('angkatan.index'))->with('success', 'Data Berhasil Di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angkatan $angkatan)
    {
        if ($angkatan->logo) {
            Storage::delete($angkatan->logo);
        }
        Angkatan::destroy($angkatan->id);

        return redirect(route('angkatan.index'))->with('success', 'Berhasil delete data');
    }
}
