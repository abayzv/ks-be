<?php

namespace App\Http\Controllers;

use App\Models\Sablon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SablonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode(Sablon::all());
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
            "name" => "required",
            "category" => "required",
            "price" => "required",
        ], [
            "name.required" => "Nama tidak boleh kosong",
            "category.required" => "Kategori tidak boleh kosong",
            "price.required" => "Harga tidak boleh kosong",
        ]);

        if ($validated) {
            try {
                $data = [
                    "name" => $request->name,
                    "category" => $request->category,
                    "price" => $request->price,
                ];
                Sablon::create($data);
                return response()->json(['status' => 'success', 'message' => 'Sablon berhasil ditambahkan']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Sablon gagal ditambahkan']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
