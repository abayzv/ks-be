<?php

namespace App\Http\Resources;

use App\Models\Queue;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'data' => QueueResource::collection(Queue::where('customer_id', $this->id)->get())
        ];
    }
}
