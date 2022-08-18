<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'no_ref' => "INV-09082022-01",
            'customer' => "Bambang",
            'phone' => "0812341234",
            'address' => "Jl. Kebon Kacang No. 1",
            'status' => "Pending",
            'payment' => "Cash",
            'down_payment' => "20000",
            'discount' => "0",
            'total_payment' => "0",
        ]);
        Transaction::create([
            'no_ref' => "INV-09082022-02",
            'customer' => "Didik",
            'phone' => "0812341234",
            'address' => "Jl. Ahmad Yani No. 1",
            'status' => "Pending",
            'payment' => "Cash",
            'down_payment' => "0",
            'discount' => "0",
            'total_payment' => "20000",
        ]);
        Transaction::create([
            'no_ref' => "INV-09082022-03",
            'customer' => "Joko",
            'phone' => "0812341234",
            'address' => "Jl. Mega Kuning No. 1",
            'status' => "Pending",
            'payment' => "Cash",
            'down_payment' => "0",
            'discount' => "0",
            'total_payment' => "20000",
        ]);
    }
}
