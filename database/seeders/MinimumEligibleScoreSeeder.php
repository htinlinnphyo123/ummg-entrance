<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use BasicDashboard\Foundations\Domain\MinimumEligibleScore\MinimumEligibleScore;

class MinimumEligibleScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            'min_education' => 2,
            'min_program' => 2,
            'min_activity' => 2,
            'min_essay' => 2,
            'min_mental' => 2,
        ];
        MinimumEligibleScore::create($data);
    }
    
    private function prepareData()
    {

    }
}
