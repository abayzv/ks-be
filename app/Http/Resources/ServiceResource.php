<?php

namespace App\Http\Resources;

use App\Models\Queue;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'slug' => $this->slug,
            'data' => QueueResource::collection(Queue::where('service_id', $this->id)->get())
        ];
    }
}
