<?php

namespace Database\Seeders;

use App\Models\WeightVote;
use Illuminate\Database\Seeder;

class WeightVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightVote::factory()->count(56)->create();
    }
}
