<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionListResource;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransactionListResource::collection(Transaction::get());
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
            'no_ref' => 'required',
            'pembayaran' => 'required',
            'product' => 'required',
        ],
        [
            'no_ref.required' => 'No. Ref tidak boleh kosong',
            'pembayaran.required' => 'Pembayaran tidak boleh kosong',
            'product.required' => 'Product tidak boleh kosong',
        ]);

        if($validated){
           try {
            DB::beginTransaction();
            $data = [
                "no_ref" => $request->no_ref,
                "pembayaran" => $request->pembayaran,
            ];
            $transaction = Transaction::create($data); 
            foreach ($request->product as $key => $value) {
                TransactionDetail::create(
                    [
                        "transaction_id" => $transaction->id,
                        "product_id" => $value['id'],
                        "quantity" => $value['quantity'],
                    ]
                );
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Transaksi Berhasil']);
           } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Transaksi Gagal']);
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