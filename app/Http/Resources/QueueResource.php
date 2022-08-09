<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\Mechanic;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\JsonResource;

class QueueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $vehicle = Vehicle::where('id', $this->vehicle_id)->first();
        $mechanic = Mechanic::where('id', $this->mechanic_id)->first();
        $customer = Customer::where('id', $this->customer_id)->first();
        $service = Service::where('id', $this->service_id)->first();
        return [
            'id' => $this->id,
            'customer' => [
                'name' => $customer->name,
                'phone' => $customer->phone
            ],
            'service_type' => [
                'name' => $service->name,
                'slug' => $service->slug
            ],
            'vehicle' => [
                'name' => $vehicle->category . " " . $vehicle->name . " " . $vehicle->year,
                'slug' => $vehicle->slug
            ],
            'mechanic' => [
                'name' => $mechanic->name,
                'phone' => $mechanic->phone,
                'image' => url('/') . "/" . $mechanic->ImageUrl
            ],
            'status' => $this->status,
            'number' => $this->queue_number,
            'service_date' => $this->created_at->format('d-m-Y H:i'),
            'created_at' => $this->created_at
        ];
    }
}
