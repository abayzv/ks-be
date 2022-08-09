<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'category' => 'required',
            'grade' => 'required',
            'type' => 'required',
            'size' => 'required',
            'color' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ],
        [
            'category.required' => 'Category tidak boleh kosong',
            'grade.required' => 'Grade tidak boleh kosong',
            'type.required' => 'Type tidak boleh kosong',
            'size.required' => 'Size tidak boleh kosong',
            'color.required' => 'Color tidak boleh kosong',
            'price.required' => 'Price tidak boleh kosong',
            'stock.required' => 'Stock tidak boleh kosong',
        ]);

        if($validated)
        {
            try {
                $data = [
                    "category" => $request->category,
                    "grade" => $request->grade,
                    "type" => $request->type,
                    "size" => $request->size,
                    "color" => $request->color,
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
