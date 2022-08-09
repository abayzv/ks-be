<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleResource;
use App\Models\Queue;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VehicleResource::collection(Vehicle::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'year' => 'required',
        ], [
            'name.required' => 'Nama kendaraan tidak boleh kosong',
            'category.required' => 'Pilih kategori terlebih dahulu',
            'year.required' => 'Tahun kendaraan wajib di isi',
        ]);
        if ($validated) {
            try {
                $data = [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name . " " . $request->year),
                    'category' => $request->category,
                    'year' => (string)$request->year
                ];
                $vehicle = Vehicle::create($data);
                return response([
                    'message' => "Kendaraan berhasil ditambahkan",
                    'data' => $data
                ], 200);
            } catch (\Throwable $th) {
                return response([
                    'message' => "Data kendaraan sudah ada",
                ], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response([
            'message' => "Kendaraan berhasil dihapus",
        ], 200);
    }
}
