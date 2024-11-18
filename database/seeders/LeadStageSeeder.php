<?php

namespace Database\Seeders;

use App\Models\LeadStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeadStage::create(['name' => 'Prospecting']);
        LeadStage::create(['name' => 'Demo']);
        LeadStage::create(['name' => 'Proposal']);
        LeadStage::create(['name' => 'Negotiation']);
        LeadStage::create(['name' => 'Conversion']);
        LeadStage::create(['name' => 'Loss']);
    }
}
