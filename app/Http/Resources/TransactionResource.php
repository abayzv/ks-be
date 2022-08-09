<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            $product = Product::where('id', $value->product_id)->first();
            $grandTotal = $grandTotal + $value->quantity*$product->price;
        }
        return [
            'no_ref' => $this->no_ref,
            'pembayaran' => $this->pembayaran,
            'item' => $item,
            'grand_total' => $grandTotal
        ];
    }
}
