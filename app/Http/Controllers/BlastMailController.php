<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBlastMailRequest;
use App\Mail\Blast;
use App\Models\BlastMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BlastMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.blastemail', [
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
     */
    public static function store($data)
    {
        if ($data['receiver'] == 'all') {
            $receiver = User::all();
        } elseif (Str::contains($data['receiver'], 'angkatan_')) {
            $cutted = Str::after($data['receiver'], 'angkatan_');
            $receiver = User::where('angkatan_id', $cutted)->get();
        } elseif (Str::contains($data['receiver'], 'kelas_')) {
            $cutted = Str::after($data['receiver'], 'kelas_');
            $receiver = User::where('kelas_id', $cutted)->get();
        }
        $data['status'] = 'On Send';
        if ($data['sender'] == null) {
            $data['sender'] = 'postmaster@smasa.id';
        }
        DB::beginTransaction();
        try {
            $stored = BlastMail::create($data);
        } catch (\Throwable $e) {
            DB::rollback();

            return $e;
        }
        DB::commit();

        // sending mail
        foreach ($receiver as $user) {
            Mail::to($user->email)->queue(new Blast($stored, $user));
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BlastMail $blastMail)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BlastMail $blastMail)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlastMailRequest $request, BlastMail $blastMail)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlastMail $blastMail)
    {
    }
}
