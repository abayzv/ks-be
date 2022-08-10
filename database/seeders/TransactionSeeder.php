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
            'pembayaran' => 'Offline',
        ]);
        Transaction::create([
            'no_ref' => "INV-09082022-02",
            'pembayaran' => 'Shopee',
        ]);
        Transaction::create([
            'no_ref' => "INV-09082022-03",
            'pembayaran' => 'Tokopedia',
        ]);
    }
}
