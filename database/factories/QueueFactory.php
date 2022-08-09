<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Mechanic;
use App\Models\Queue;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class QueueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Queue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "customer_id" => Customer::factory(),
            "service_id" => Service::factory(),
            "mechanic_id" => Mechanic::factory(),
            "vehicle_id" => Vehicle::factory(),
            "status" => 'pending',
        ];
    }
}
