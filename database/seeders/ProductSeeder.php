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
            "category" => "Kaos Dewasa",
            "grade" => "Premium",
            "type" => "Pendek",
            "size" => "XL",
            'color' => "Hitam",
            'price' => 35000,
            'stock' => 30
        ]);
        Product::create([
            "category" => "Kaos Raglan",
            "grade" => "Standard",
            "type" => "Pendek",
            "size" => "L",
            'color' => "Putih Navy",
            'price' => 40000,
            'stock' => 30
        ]);
        Product::create([
            "category" => "Kaos Polo",
            "grade" => "Standard",
            "type" => "Pendek",
            "size" => "M",
            'color' => "Hitam",
            'price' => 45000,
            'stock' => 30
        ]);
        Product::create([
            "category" => "Crewneck",
            "grade" => "Standard",
            "type" => "Pendek",
            "size" => "XL",
            'color' => "Hitam",
            'price' => 90000,
            'stock' => 30
        ]);
        Product::create([
            "category" => "Hoodie",
            "grade" => "Standard",
            "type" => "Pendek",
            "size" => "XL",
            'color' => "Hitam",
            'price' => 95000,
            'stock' => 30
        ]);
    }
}
