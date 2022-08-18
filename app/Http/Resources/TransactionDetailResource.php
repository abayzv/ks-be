<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Sablon;
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
        $sablon = Sablon::where('id', $this->sablon_type)->first();
        return [
            "nama" => $product->category . " " . $product->type . " " . $product->grade,
            'warna' => $product->color,
            'ukuran' => $product->size,
            "harga" => (int)  $product->price,
            "quantity" => $this->quantity,
            "sablon" => $sablon->name,
            "sablon_price" => $sablon->price,
            "sub_total" => ($product->price + $sablon->price) * $this->quantity
        ];
    }
}
