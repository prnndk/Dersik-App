<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorevoteRequest;
use App\Http\Requests\UpdatevoteRequest;
use App\Models\Angkatan;
use App\Models\pemilih;
use App\Models\vote;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('milih.voting.index', [
            'data' => vote::with('angkatan')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('milih.voting.add', [
            'angkatan' => Angkatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorevoteRequest $request)
    {
        $validated = $request->validate([
           'nama' => 'required|min:5',
            'link' => 'required|alpha|between:4,10',
            'angkatan_id' => 'required',
            'mulai_coblos' => 'required|date',
            'akhir_coblos' => 'required|date',
        ]);
        $setor = vote::create($validated);
        if ($setor) {
            $this->notifyBot('Pemilihan baru telah dibuat! dengan nama '.$setor->nama.' oleh '.auth()->user()->name);

            return redirect(route('voting.index'))->with('success', 'Berhasil membuat pemilihan dengan nama '.$validated['nama']);
        } else {
            return redirect(route('voting.index'))->with('toast_error', 'Terjadi Kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(vote $vote)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(vote $vote)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatevoteRequest $request, vote $vote)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\vote $vote
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(vote $voting)
    {
        $voters = pemilih::where('vote_id', $voting->id)->get();
        foreach ($voters as $vtr) {
            pemilih::destroy($voters->id);
        }
        vote::destroy($voting->id);

        return redirect(route('voting.index'))->with('success', 'Data '.$voting->nama.' Berhasil Dihapus');
    }
}
