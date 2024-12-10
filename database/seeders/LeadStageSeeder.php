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
        $titles = ['Prospecting', 'Demo', 'Proposal', 'Negotiation', 'Conversion', 'Loss'];

        foreach ($titles as $index => $title) {
            LeadStage::create(['title' => $title, 'order' => $index + 1]);
        }
    }
}
