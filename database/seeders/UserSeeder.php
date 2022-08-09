<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'username' => 'admin',
                'name' => 'Admin',
                'password' => bcrypt('admin'),
                'email' => 'admin@admin.com',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'demo',
                'name' => 'Demo',
                'password' => bcrypt('demo'),
                'email' => 'demo@demo.com',
                'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ])->each(function ($user) {
            DB::table('users')->insert($user);
        });
    }
}
