<?php

namespace App\Http\Controllers;

use App\Models\kateginfo;
use Illuminate\Http\Request;

class KateginfoController extends Controller
{
    public function create()
    {
        return view('services.info.kategori', [
            'kateg' => kateginfo::all(),
        ]);
    }

    public function store(Request $req)
    {
        $valid = $req->validate([
            'name' => 'required|unique:kateginfos',
        ]);
        kateginfo::create($valid);

        return redirect(route('informasi.index'))->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $req, $id)
    {
        $data = kateginfo::where('id', $id)->first();
        $rule = ['name' => 'required|unique:kateginfos'];
        $validated = $req->validate($rule);
        $data->update($validated);

        return redirect(route('makeKateginfo'))->with('success', 'Data berhasil di update');
    }

    public function destroy($id)
    {
        $data = kateginfo::where('id', $id)->first();
        $data->destroy();

        return redirect(route('makeKateginfo'))->with('success', 'Data berhasil dihapus');
    }
}
