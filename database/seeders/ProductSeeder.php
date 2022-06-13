<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => 'Noodle',
            'amount' => 100,
            'category_id' => '1',
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product_name' => 'Chocolate iced',
            'amount' => 50,
            'category_id' => '1',
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'product_name' => 'Tiramisu',
            'amount' => 20,
            'category_id' => '1',
            'state' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
