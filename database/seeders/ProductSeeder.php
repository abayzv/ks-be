<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "category" => "Kaos",
            "grade" => "Standard",
            "type" => "Pendek",
            "size" => "L",
            'color' => "Hitam",
            'price' => 35000,
            'stock' => 30
        ]);
    }
}
