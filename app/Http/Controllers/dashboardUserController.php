<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\Angkatan;
use App\Models\kelas;
use App\Models\Regency;
use App\Models\User;
use App\Notifications\NotifyBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class dashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'user' => User::with(['kelas', 'Regency'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', [
            'kab' => Regency::all()->sortBy('name'),
            'angkatans' => Angkatan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|min:5',
            'email' => 'required|unique:users|email:dns',
            'username' => 'required|unique:users|min:4',
            'kelas_id' => 'required|exists:kelas,id',
            'angkatan_id' => 'required|exists:angkatans,id',
            'tempatlahir' => 'required|size:4|string',
            'dob' => 'required|date',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = date('Y-m-d H:i:s');
        $validated['uuid'] = Str::uuid();

        DB::beginTransaction();
        try {
            User::create($validated);
        } catch (\Throwable $e) {
            DB::rollback();

            return redirect(route('userlist.index'))->with('warning', 'Terjadi Kesalahan data gagal ditambahkan. Pesan: '.$e);
        }
        DB::commit();
        $this->notifyBot('User baru telah dibuat oleh *'.auth()->user()->name.'* dengan nama '.$validated['name'].' dan role '.$validated['role']);

        return redirect(route('userlist.index'))->with('success', 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.user.detail', [
            'data' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.show', [
            'user' => $user,
            'kelas' => kelas::all(),
            'kab' => Regency::all()->sortBy('name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        $data = User::FindorFail($id);
        $upval = $request->validate([
            'kelas_id' => 'required',
            'tempatlahir' => 'required',
            'dob' => 'required|date',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);
        if ($request->email != $data->email) {
            $upval['email'] = 'required|unique:users|email:dns';
        }
        if ($request->username != $data->username) {
            $upval['username'] = 'required|unique:users|min:4';
        }
        if ($request->name != $data->name) {
            $upval['name'] = 'required|unique:users|min:5';
        }
        $upval['password'] = Hash::make($upval['password']);
        $update = User::where('id', $data->id)->update($upval);
        if ($update) {
            return redirect(route('userlist.index'))->with('success', 'Data User Berhasil Di update');
        } else {
            return redirect(route('userlist.index'))->with('error', 'Data Gagal Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Notification::send(auth()->user(), new NotifyBot('User dengan nama '.$user->name.' telah dihapus oleh '.auth()->user()->name));

        $user->delete();

        return redirect(route('userlist.index'))->with('success', 'Data has been deleted');
    }

    public function exportuser()
    {
        return Excel::download(new UserExport(), 'UserData.xlsx');
    }

    public function importuser(Request $request)
    {
        $import = Excel::import(new UserImport(), $request->file('file')->store('temp'));

        return redirect(route('userlist.index'))->with('success', 'Berhasil Import Data!');
    }
}
