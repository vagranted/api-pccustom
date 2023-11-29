<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('component_types')->insert([
            ['title' => 'Видеокарта'],
            ['title' => 'Процессор'],
            ['title' => 'ОЗУ']
        ]);
    }
}
