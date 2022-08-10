<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode(ProductResource::collection(Product::get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'category' => 'required',
                'grade' => 'required',
                'type' => 'required',
                'size' => 'required',
                'color' => 'required',
                'price' => 'required',
                'stock' => 'required',
            ],
            [
                'category.required' => 'Nama tidak boleh kosong',
                'grade.required' => 'Kualitas tidak boleh kosong',
                'type.required' => 'Lengan tidak boleh kosong',
                'size.required' => 'Ukuran tidak boleh kosong',
                'color.required' => 'Warna tidak boleh kosong',
                'price.required' => 'Harga tidak boleh kosong',
                'stock.required' => 'Stock tidak boleh kosong',
            ]
        );

        if ($validated) {
            try {
                $data = [
                    "category" => ucwords(Str::lower($request->category)),
                    "grade" => $request->grade,
                    "type" => $request->type,
                    "size" => $request->size,
                    "color" => ucwords(Str::lower($request->color)),
                    "price" => $request->price,
                    "stock" => $request->stock,
                ];
                $products = Product::create($data);
                return response()->json(['status' => 'success', 'message' => 'Product berhasil ditambahkan']);
            } catch (\Throwable $th) {
                return response()->json(['status' => 'error', 'message' => 'Product gagal ditambahkan']);
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
