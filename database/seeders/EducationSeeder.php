<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateEligiblityScore();
    }

    public function generateEligiblityScore()   
    {
        $this->generateBEHScore();
        $this->generateBECAScore();
        $this->generateGEDScore();
        $this->generateIGCSEScore();
    }

    public function generateBECAScore()
    {
        $becasEligible = [
            [
                'exam_type' => 'BECA',
                'margin_score' => 17,
                'eligible_score' => 0,
            ],
            [
                'exam_type' => 'BECA',
                'margin_score' => 18,
                'eligible_score' => 1,
            ],
            [
                'exam_type' => 'BECA',
                'margin_score' => 21,
                'eligible_score' => 2,
            ],
            [
                'exam_type' => 'BECA',
                'margin_score' => 24,
                'eligible_score' => 3,
            ],
            [
                'exam_type' => 'BECA',
                'margin_score' => 27,
                'eligible_score' => 4,
            ],
            [
                'exam_type' => 'BECA',
                'margin_score' => 30,
                'eligible_score' => 5,
            ]
        ];
        $this->generateScores($becasEligible);
    }

    public function generateBEHScore()
    {
        $behsEligible = [
            [
                'exam_type' => 'behs',
                'margin_score' => 374,
                'eligible_score' => 0,
            ],[
                'exam_type' => 'BEHS',
                'margin_score' => 370,
                'eligible_score' => 1,
            ],[
                'exam_type' => 'BEHS',
                'margin_score' => 425,
                'eligible_score' => 2,
            ],[
                'exam_type' => 'BEHS',
                'margin_score' => 450,
                'eligible_score' => 3,
            ],[
                'exam_type' => 'BEHS',
                'margin_score' => 475,
                'eligible_score' => 4,  
            ],[
                'exam_type' => 'BEHS',
                'margin_score' => 500,
                'eligible_score' => 5,
            ]
        ];
        $this->generateScores($behsEligible);
    }

    public function generateGEDScore()
    {
        $gedsEligible = [
            [
                'exam_type' => 'GED',
                'margin_score' => 599,
                'eligible_score' => 0,
            ],[
                'exam_type' => 'GED',
                'margin_score' => 600,
                'eligible_score' => 1,
            ],[
                'exam_type' => 'GED',
                'margin_score' => 625,
                'eligible_score' => 2,
            ],[
                'exam_type' => 'GED',
                'margin_score' => 650,
                'eligible_score' => 3,
            ],[
                'exam_type' => 'GED',
                'margin_score' => 675,
                'eligible_score' => 4,
            ],[
                'exam_type' => 'GED',
                'margin_score' => 700,
                'eligible_score' => 5,
            ]
        ];
        $this->generateScores($gedsEligible);
    }

    public function generateIGCSEScore()
    {
        $igcseEligible = [
            [
                'exam_type' => 'IGCSE',
                'margin_score' => 17,
                'eligible_score' => 0,
            ],[
                'exam_type' => 'IGCSE',
                'margin_score' => 18,
                'eligible_score' => 1,
            ],[
                'exam_type' => 'IGCSE',
                'margin_score' => 21,
                'eligible_score' => 2,
            ],[
                'exam_type' => 'IGCSE',
                'margin_score' => 24,
                'eligible_score' => 3,
            ],[
                'exam_type' => 'IGCSE',
                'margin_score' => 27,
                'eligible_score' => 4,
            ],[
                'exam_type' => 'IGCSE',
                'margin_score' => 30,
                'eligible_score' => 5,
            ]
        ];
        $this->generateScores($igcseEligible);
    }

    protected function generateScores($scores)
    {
        foreach ($scores as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('eligible_education_scores')->insert($item);
        }
    }

}
