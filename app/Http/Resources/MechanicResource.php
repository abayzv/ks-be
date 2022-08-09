<?php

namespace App\Http\Resources;

use App\Models\Queue;
use Illuminate\Http\Resources\Json\JsonResource;

class MechanicResource extends JsonResource
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
            'imageUrl' => url('/') . "/" . $this->ImageUrl,
            'isReady' => $this->isReady == 1 ? true : false,
            'data' => QueueResource::collection(Queue::where('mechanic_id', $this->id)->get())
        ];
    }
}
