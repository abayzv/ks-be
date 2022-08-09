<?php

namespace App\Http\Resources;

use App\Models\TransactionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $transaction = TransactionDetail::where('product_id', $this->id)->get();
        return [
            'nama' => $this->category." ".$this->type." ".$this->grade,
            'kategori' => $this->category,
            'panjang_pendek' => $this->type,
            'kualitas' => $this->grade,
            'ukuran' => $this->size,
            'warna' => $this->color,
            'harga' => $this->price,
            'stock_awal' => $this->stock,
            'stock_tersedia' => $this->stock - $transaction->sum('quantity'),
            'penjualan' => $transaction->sum('quantity')
        ];
    }
}
