<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationEligibleScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->prepareData();
        DB::table("educationEligibleScores")->insert($data);
    }
    
    private function prepareData()
    {
        $insertData = [];
        foreach (range(1,20) as $a){
            $insertData[] = [
                'name' => $a . 'name',        
            ];
        };
        return $insertData;
    }
}
