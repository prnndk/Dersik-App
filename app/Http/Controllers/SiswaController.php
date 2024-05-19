<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresiswaRequest;
use App\Http\Requests\UpdatesiswaRequest;
use App\Mail\PendataanMail;
use App\Mail\ReviewPendataanMail;
use App\Models\Angkatan;
use App\Models\detailstatus;
use App\Models\kelas;
use App\Models\Regency;
use App\Models\siswa;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('services.pendataan.index', [
            'datum' => siswa::where('user_id', auth()->user()->id)->get(),
            'admin' => siswa::all(),
            'status' => status::all(),
            'cs1' => siswa::where('status', '1')->count(),
            'cs2' => siswa::where('status', '2')->count(),
            'cs3' => siswa::where('status', '3')->count(),
            'cs4' => siswa::where('status', '4')->count(),
            'mostclass' => siswa::select('kelas')->selectRaw('COUNT(*) AS count')->groupBy('kelas')->orderByDesc('count')->first(),
            'mostcity' => siswa::select('domisili')->selectRaw('COUNT(*) AS count')->groupBy('domisili')->orderByDesc('count')->first(),
            'mostuni' => siswa::select('instansi')->selectRaw('COUNT(*) AS count')->groupBy('instansi')->orderByDesc('count')->first(),
            'jmldata' => siswa::count(),
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
            $data = siswa::where('user_id', auth()->user()->id)->first();
            if ($data) {
                return back()->with('info', 'Anda sudah melakukan pendataan, silahkan edit data anda jika ada kesalahan');
            }
        }

        return view('services.pendataan.create', [
            'kelas' => kelas::all(),
            'kab' => Regency::all(),
            'angkatan' => Angkatan::all(),
            'status' => status::all(),
            'instansi' => detailstatus::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoresiswaRequest $request)
    {
        $validated = $request->validated();
        if ($request->instansi == null && in_array($request->status, [3, 5])) {
            $validated['instansi'] = 'Gapyear/Menikah';
        }
        if ($validated['instansi'] != 'Gapyear/Menikah') {
            $get = detailstatus::where('id', $validated['instansi'])->first();
            $validated['instansi'] = $get->nama;
        }
        if ($request->instansi == null && $request->instansi_manual) {
            $validated['instansi'] = $validated['instansi_manual'];
        }
        if ($request->teman_smasa == null) {
            $validated['teman_smasa'] = 'Tidak Ada';
        }
        if (auth()->user()) {
            if (auth()->user()->role == 'User') {
                $cek = siswa::where('user_id', auth()->user()->id)->first();
                if ($cek) {
                    return back()->with('info', 'Anda sudah melakukan pendataan, silahkan edit data anda jika ada kesalahan');
                } else {
                    $validated['user_id'] = auth()->user()->id;
                }
            } else {
                $validated['user_id'] = auth()->user()->id;
            }
        } else {
            $validated['user_id'] = null;
        }
        $validated['url'] = Str::uuid();
        $validated['ip'] = $request->ip();
        $validated['review'] = 0;
        $validated['message'] = 'Belum ada pesan';
        DB::beginTransaction();
        try {
            $success_data = Siswa::create($validated);
        } catch (\Throwable $th) {
            DB::rollBack();

            $this->notifyBot('Terjadi kegagalan percobaan input pendataan \n Error Message: '.$th->getMessage);

            return redirect(route('pendataan.index'))->with('toast_error', 'Terjadi Kesalahan ketika mengisi form');
        }
        DB::commit();
        Mail::to($success_data->email)->queue(new PendataanMail($success_data));
        $this->notifyBot('Pengisian pendataan baru via dashboard dengan nama '.$success_data->nama);

        return redirect(route('pendataan.index'))->with('success', 'Terimakasih Telah Mengisi Pendataan, salinan pendataan telah dikirim ke email anda');
    }

    public function storeAPI(StoresiswaRequest $request)
    {
        $validated = $request->validated();
        if ($request->instansi == null && in_array($request->status, [3, 5])) {
            $validated['instansi'] = 'Gapyear/Menikah';
        }
        if ($validated['instansi'] != 'Gapyear/Menikah') {
            $get = detailstatus::where('id', $validated['instansi'])->first();
            $validated['instansi'] = $get->nama;
        }
        if ($request->instansi == null && $request->instansi_manual) {
            $validated['instansi'] = $validated['instansi_manual'];
        }
        if ($request->user_id) {
            $validated['user_id'] = $request->user_id;
        } else {
            $validated['user_id'] = null;
        }
        $validated['url'] = Str::uuid();
        $validated['ip'] = $request->ip();
        $validated['review'] = 0;
        $validated['message'] = 'Belum ada pesan';
        DB::beginTransaction();
        try {
            $success_data = Siswa::create($validated);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->errorResponse($th->getMessage, 500);
        }
        DB::commit();
        Mail::to($success_data->email)->queue(new PendataanMail($success_data));
        $this->notifyBot('Pengisian pendataan baru via publik API dengan nama '.$success_data->nama);
        $this->successResponseWithData($success_data);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $siswa = siswa::where('url', $url)->first();
        if ($siswa) {
            if ($siswa->user_id != auth()->user()->id && auth()->user()->role == 'User') {
                return redirect(route('pendataan.index'))->with('toast_error', 'Permission Denied');
            } else {
                return view('services.pendataan.view', [
                    'data' => $siswa,
                ]);
            }
        } else {
            return redirect(route('pendataan.index'))->with('toast_error', 'Data Tidak Ditemukan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        $siswa = siswa::where('url', $url)->first();
        if ($siswa) {
            return view('services.pendataan.edit', [
                'data' => $siswa,
                'kelas' => kelas::all(),
                'kab' => Regency::all(),
                'angkatan' => Angkatan::all(),
                'status' => status::all(),
                'instansi' => detailstatus::all(),
            ]);
        } else {
            return redirect(route('pendataan.index'))->with('toast_error', 'Data Tidak Ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesiswaRequest $request, $id)
    {
        $siswa = siswa::where('id', $id)->first();
        $validUpdate = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:dns',
            'kelas' => 'required',
            'status' => 'required',
            'instansi' => Rule::requiredIf($request->status == [1, 2, 4]),
            'instansi_manual' => Rule::requiredIf($request->status == [1, 2, 4]),
            'detail_status' => 'required',
            'domisili' => 'required',
            'teman_smasa' => 'required',
            'banyak_teman' => 'requiredIf:teman_smasa,ada',
            'angkatan_id' => 'required',
            'nomor' => 'required|digits_between:10,13',
            'review' => 'required|digits_between:0,2',
            'message' => Rule::requiredIf($request->review == 2),
        ]);
        $validUpdate['pengajuan'] = 1;
        DB::beginTransaction();
        try {
            $siswa->update($validUpdate);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect(route('pendataan.index'))->with('toast_error', 'Terjadi kesalahan saat update data');
        }
        DB::commit();

        Mail::to($siswa->email)->queue(new ReviewPendataanMail($siswa));

        return redirect(route('pendataan.index'))->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        siswa::where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

    public function cekDetail(Request $req)
    {
        $detail = detailstatus::where('id_status', $req->id_status)->get();

        return response()->json($detail, 200);
    }

    public function publicform()
    {
        return view('public.form-public', [
            'kelas' => kelas::all(),
            'kab' => Regency::all(),
            'angkatan' => Angkatan::all(),
            'status' => status::all(),
            'instansi' => detailstatus::all(),
        ]);
    }

    public function cekpendataan($url)
    {
        $siswa = siswa::where('url', $url)->first();
        if ($siswa) {
            return view('services.pendataan.cek', [
                'data' => $siswa,
            ]);
        } else {
            abort(404);
        }
    }
}
