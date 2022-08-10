<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionDetail::create([
            "transaction_id" => 1,
            "product_id" =>1,
            "quantity" => 3,
            "sablon_type" => 1
        ]);
        TransactionDetail::create([
            "transaction_id" => 1,
            "product_id" =>2,
            "quantity" => 1,
            "sablon_type" => 1
        ]);
        TransactionDetail::create([
            "transaction_id" => 2,
            "product_id" =>4,
            "quantity" => 1,
            "sablon_type" => 2
        ]);
    }
}
