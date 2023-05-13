<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreregisEmailRequest;
use App\Http\Requests\UpdateregisEmailRequest;
use App\Models\domainlist;
use App\Models\regisEmail;
use App\Notifications\NotifyBot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class RegisEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('services.regismail', [
            'admin' => regisEmail::with(['User', 'domain'])->get(),
            'index' => regisEmail::where('user_id', auth()->user()->id)->with(['User', 'domain'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.createregismail', [
            'domain' => domainlist::with('Angkatan')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreregisEmailRequest $request)
    {
        $validatedData = $request->validate([
            'domain_id' => 'required|digits_between:1,3',
            'email' => 'required|unique:regis_emails',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['nama'] = auth()->user()->name;
        $validatedData['username'] = auth()->user()->username;
        DB::beginTransaction();
        try {
            regisEmail::create($validatedData);
        } catch (\Throwable $e) {
            DB::rollback();

            return redirect('/dashboard/regis-mail')->with('warning', 'Registrasi Email anda gagal '.$e);
        }
        DB::commit();
        Notification::send(auth()->user(), new NotifyBot('Permintaan registrasi email baru telah dibuat oleh '.auth()->user()->name));

        return redirect('/dashboard/regis-mail')->with('toast_success', 'Terimakasih telah mengajukan email, permintaan anda sedang direviu Admin');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\regisEmail $regisEmail
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('services.detailmail', [
            'email' => regisEmail::where('id', $id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\regisEmail $email
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('services.editmail', [
            'domain' => domainlist::all(),
            'email' => regisEmail::where('id', $id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\regisEmail $regisEmail
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateregisEmailRequest $request, $id)
    {
        $mail = regisEmail::where('id', $id)->first();
        $rules = [
            'nama' => 'required',
            'username' => 'required',
            'status' => 'nullable',
            'alasan' => 'nullable',
            'password' => 'nullable',
            'domain_id' => 'required|digits_between:1,3',
        ];
        if ($request->email != $mail->email) {
            $rules['email'] = 'required|unique:regis_emails';
        }
        if ($request->status == null) {
            regisEmail::where('id', $mail->id)->update(['status' => 'Dalam Peninjauan']);
        }
        $validatedData = $request->validate($rules);
        $upgrade = regisEmail::where('id', $mail->id)->update($validatedData);
        if ($upgrade) {
            return redirect('dashboard/regis-mail')->with('success', 'Permohonan Berhasil di Update');
        } else {
            return redirect('dashboard/regis-mail')->with('toast_error', 'Data gagal diupdate, coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\regisEmail $regisEmail
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mail = regisEmail::where('id', $id)->first();
        regisEmail::destroy($mail);

        return redirect('/dashboard/regis-mail')->with('success', 'Data has been deleted');
    }
}
