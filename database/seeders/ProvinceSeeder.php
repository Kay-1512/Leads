<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Province::create(['name' => 'Eastern Cape', 'abbreviation' => 'EC']);
        Province::create(['name' => 'Free State', 'abbreviation' => 'FS']);
        Province::create(['name' => 'Gauteng', 'abbreviation' => 'GP']);
        Province::create(['name' => 'KwaZulu-Natal', 'abbreviation' => 'KZN']);
        Province::create(['name' => 'Limpopo', 'abbreviation' => 'LP']);
        Province::create(['name' => 'Mpumalanga', 'abbreviation' => 'MP']);
        Province::create(['name' => 'Northern Cape', 'abbreviation' => 'NC']);
        Province::create(['name' => 'North West', 'abbreviation' => 'NW']);
        Province::create(['name' => 'Western Cape', 'abbreviation' => 'WC']);
    }
}
