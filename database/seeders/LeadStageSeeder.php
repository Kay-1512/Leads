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
        LeadStage::create(['title' => 'Prospecting']);
        LeadStage::create(['title' => 'Demo']);
        LeadStage::create(['title' => 'Proposal']);
        LeadStage::create(['title' => 'Negotiation']);
        LeadStage::create(['title' => 'Conversion']);
        LeadStage::create(['title' => 'Loss']);
    }
}
