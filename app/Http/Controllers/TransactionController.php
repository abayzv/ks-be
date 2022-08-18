<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionDetailResource;
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
        return Transaction::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return json_encode($request->all());
        $validated = $request->validate(
            [
                'nama' => 'required',
                'hp' => 'required',
                'alamat' => 'required',
                'metode_pembayaran' => 'required',
            ],
            [
                'nama.required' => 'Nama Customer wajib di isi',
                'hp.required' => 'Nomor HP wajib di isi',
                'alamat.required' => 'Alamat harus di isi',
                'metode_pembayaran.required' => 'Silahkan pilih jenis pembayaran',
            ]
        );

        // generate invoice number with format INV-DDMMYY-(auto increment)
        $invoice_number = 'INV-' . date('dmY') . '-' . Transaction::count() + 1;

        if ($validated) {
            try {
                DB::beginTransaction();
                $data = [
                    "no_ref" => $invoice_number,
                    "customer" => $request->nama,
                    "phone" => $request->hp,
                    "address" => $request->alamat,
                    "status" => $request->dp > 0 ? "Belum Lunas" : "Lunas",
                    "payment" => $request->metode_pembayaran,
                    "down_payment" => $request->dp,
                    "discount" => $request->discount,
                    "total_payment" => $request->bayar,
                ];
                $transaction = Transaction::create($data);
                try {
                    foreach ($request->cart as $key => $value) {
                        TransactionDetail::create(
                            [
                                "transaction_id" => $transaction->id,
                                "product_id" => $value['id'],
                                "quantity" => $value['jumlah'],
                                "sablon_type" => $value['sablon_type'],
                                "note" => $value['note'],
                            ]
                        );
                    }
                } catch (\Throwable $th) {
                    return response()->json(['status' => 'error', 'message' => "Silahkan masukan produk"]);
                    DB::rollBack();
                }
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Transaksi Berhasil']);
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
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
        // return transaction with transaction detail
        return new TransactionListResource(Transaction::find($id));
    }

    public function getInvoiceByNoRef(Request $request)
    {
        // return json_encode($request->no_ref);
        $transaction = new TransactionListResource(Transaction::where('no_ref', $request->no_ref)->first());
        if ($transaction) {
            return response()->json(['status' => 'success', 'message' => 'Tagihan ditemukan', 'data' => $transaction]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Tagihan tidak ditemukan']);
        }
    }

    public function repayment(Request $request)
    {
        $validated = $request->validate(
            [
                'no_ref' => 'required',
                'bayar' => 'required',
            ],
            [
                'no_ref.required' => 'No. Ref wajib di isi',
                'bayar.required' => 'Jumlah pembayaran wajib di isi',
            ]
        );
        if ($validated) {
            $trans = Transaction::where('no_ref', $request->no_ref)->first();
            $transaction = new TransactionListResource(Transaction::where('no_ref', $request->no_ref)->first());
            $data = $transaction->toResponse(app('request'))->getData(true);
            $product = $data['data']['product'];
            $total_payment = 0;
            foreach ($product as $key => $value) {
                $total_payment += $value['sub_total'];
            }
            if ($transaction) {
                if ($transaction->status == "Belum Lunas") {
                    if (($data['data']['dp'] + $request->bayar) >= $total_payment) {
                        $trans->status = "Lunas";
                        $trans->total_payment = $total_payment;
                        $trans->save();
                    } else {
                        $trans->status = "Belum Lunas";
                        $trans->down_payment = $data['data']['dp'] + $request->bayar;
                        $trans->save();
                    }
                    return response()->json(['status' => 'success', 'message' => 'Pembayaran berhasil']);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Pembayaran gagal']);
                }
            }
        }
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
