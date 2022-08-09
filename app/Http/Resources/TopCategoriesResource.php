<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class TopCategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // get array keys
        $keys = array_keys($this->resource->toArray());
        $type = $keys[0];
        $products = Product::where($type, $this[$type])->get();
        // count transaction by products each category
        $transactions = TransactionDetail::whereIn('product_id', $products->pluck('id'))->get();
        // // sum quantity each transactions by category
        $quantity = $transactions->sum('quantity');

        return [
            'name' => $this[$type],
            'total' => $quantity
        ];
    }
}
