<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddETHNICALSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scores = [
            [
                'exam_type' => 'ETHNICAL',
                'margin_score' => 17,
                'eligible_score' => 0,
            ],
            [
                'exam_type' => 'ETHNICAL',
                'margin_score' => 18,
                'eligible_score' => 1,
            ],
            [
                'exam_type' => 'ETHNICAL',
                'margin_score' => 21,
                'eligible_score' => 2,
            ],
            [
                'exam_type' => 'ETHNICAL',
                'margin_score' => 24,
                'eligible_score' => 3,
            ],
            [
                'exam_type' => 'ETHNICAL',
                'margin_score' => 27,
                'eligible_score' => 4,
            ],
            [
                'exam_type' => 'ETHNICAL',
                'margin_score' => 30,
                'eligible_score' => 5,
            ]
        ];
        foreach ($scores as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('education_eligible_score')->insert($item);
        }

        $singleEDUMARK = [
            'exam_type' => 'ETHNICAL',
            'sub_1' => 3,
            'sub_2' => 3,
            'sub_3' => 3,
            'sub_4' => 3,
            'sub_5' => 3,
            'sub_6' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('single_edu_eligible_marks')->insert($singleEDUMARK);
    }
}
