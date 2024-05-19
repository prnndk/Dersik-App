<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoredashlinkRequest;
use App\Http\Requests\UpdatedashlinkRequest;
use App\Models\dashlink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return view('dashboard.dashlinks.index', [
            'data' => dashlink::all(),
            'btn_color' => [
                'Primary',
                'Secondary',
                'Success',
                'Danger',
                'Warning',
                'Info',
                'Light',
                'Dark',
                'Link',
            ],
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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoredashlinkRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ($validated) {
            DB::beginTransaction();
            try {
            dashlink::create($validated);
            }catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'success' => 'Data Added successfully.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(dashlink $dashlink)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(dashlink $dashlink)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function update(UpdatedashlinkRequest $request)
    {
        $validated = $request->validated();
        $dashboardlinks = dashlink::where('id', $request->id)->first();
        if ($request->nama) {
            $dashboardlinks->nama = $request->nama;
        }
        if ($request->route) {
            $dashboardlinks->route = $request->route;
        }
        if ($request->icon) {
            $dashboardlinks->icon = $request->icon;
        }
        if ($request->btn_color) {
            $dashboardlinks->btn_color = $request->btn_color;
        }
        if($request->informasi)
        {
            $dashboardlinks->informasi = $request->informasi;
        }
        if ($validated) {
            DB::beginTransaction();
            try {
                $dashboardlinks->save();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
            DB::commit();

            return response()->json([
                'status' => 200,
                'success' => 'Data Updated successfully.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(dashlink $dashlink)
    {
    }

    public function apiLink(Request $request)
    {
        $data = dashlink::where('id', $request->id)->first();
        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'Data Not Found',
            ]);
        }
    }
}
