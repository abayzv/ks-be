<?php

namespace Database\Seeders;

use App\Models\Sablon;
use Illuminate\Database\Seeder;

class SablonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sablon::create([
            "name" => "Tanpa Sablon",
            "category" => "Polos",
            "price" => "0"
        ]);
        Sablon::create([
            "name" => "DTF 1 Sisi A4",
            "category" => "DTF",
            "price" => "35000"
        ]);
        Sablon::create([
            "name" => "DTF 2 Sisi A4",
            "category" => "DTF",
            "price" => "50000"
        ]);
        Sablon::create([
            "name" => "Poliflex 2 Sisi A4",
            "category" => "Poliflex",
            "price" => "50000"
        ]);
    }
}
