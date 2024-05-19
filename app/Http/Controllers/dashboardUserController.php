<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UserImport;
use App\Models\Angkatan;
use App\Models\kelas;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public function update(Request $request, User $user)
    {
        $rules = [
            'kelas_id' => 'required',
            'tempatlahir' => 'required',
            'dob' => 'required|date',
            'role' => 'required',
            'password' => 'required|min:8',
        ];
        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users|email:dns';
        }
        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users|min:4';
        }
        if ($request->name != $user->name) {
            $rules['name'] = 'required|unique:users|min:5';
        }
        $validated = $request->validate($rules);
        if ($request->password) {
            $validated['password'] = Hash::make($validated['password']);
        }
        DB::beginTransaction();
        try {
            $user->update($validated);
        } catch (\Exception $e) {
            DB::rollback();
            $this->notifyBot('Error saat update user. '.$e->getMessage());

            return redirect(route('userlist.index'))->with('toast_error', 'Terjadi Kesalahan data gagal diupdate.');
        }
        DB::commit();

        return redirect(route('userlist.index'))->with('success', 'Data User Berhasil Di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->notifyBot('User dengan nama '.$user->name.' telah dihapus oleh '.auth()->user()->name);

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
