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
        if ($keys[0] != "color") {
            $products = Product::where($type, $this[$type])->get();
        } else {
            $products = Product::where(["color" => $this[$keys[0]], "category" => $this[$keys[1]]])->get();
        }
        // count transaction by products each category
        $transactions = TransactionDetail::whereIn('product_id', $products->pluck('id'))->get();
        // // sum quantity each transactions by category
        $quantity = $transactions->sum('quantity');

        return [
            'name' => $keys[0] == "color" ? $this[$type] . " (" . $this[$keys[1]] . ")" : $this[$type],
            'total' => $quantity
        ];
    }
}
