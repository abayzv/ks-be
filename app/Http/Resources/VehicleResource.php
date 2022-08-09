<?php

namespace App\Http\Resources;

use App\Models\Queue;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'year' => $this->year,
            'category' => $this->category,
            'data' => QueueResource::collection(Queue::where('vehicle_id', $this->id)->get())
        ];
    }
}
