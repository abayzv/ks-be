<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::where('id', $this->product_id)->first();
        return [
            "nama" => $product->category." ".$product->type." ".$product->grade,
            'warna' => $product->color,
            'ukuran' => $product->size,
            "harga" => $product->price,
            "quantity" => $this->quantity,
            "sub_total" => $product->price * $this->quantity
        ];
    }
}
