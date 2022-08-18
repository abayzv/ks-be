<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $transactionDetail = TransactionDetail::where('transaction_id', $this->id)->get();
        $item = TransactionDetailResource::collection($transactionDetail);
        $grandTotal = 0;
        foreach ($item as $key => $value) {
            $grandTotal += $value['sub_total'];
        }
        return [
            'customer' => $this->customer,
            'hp' => $this->phone,
            'alamat' => $this->address,
            'no_ref' => $this->no_ref,
            'status' => $this->status,
            'pembayaran' => $this->payment,
            'jumlah' => $item->sum('quantity'),
            'product' => $item,
            'diskon' => $this->discount,
            'dp' => $this->down_payment,
            'bayar' => $this->total_payment,
            // format date to dd-mm-yyyy hh:ii
            'tanggal' => date('d-m-Y H:i', strtotime($this->created_at)),
        ];
    }
}
