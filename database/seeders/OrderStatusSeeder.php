<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_statuses')->insert([
            ['title' => 'cart'],
            ['title' => 'created'],
            ['title' => 'completed']
        ]);
    }
}
