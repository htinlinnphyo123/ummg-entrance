<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantRecordSeeder extends Seeder
{
    public function run()
    {
        $examTypes = ['BEHS', 'BECA', 'GED', 'IGCSE'];
        
        for ($i = 0; $i < 200; $i++) {
            $examType = $examTypes[array_rand($examTypes)];
            
            $sub1 = $examType === 'GED' ? rand(60,200) : rand(20, 100);
            $sub2 = $examType === 'GED' ? rand(60,200) : rand(20, 100);
            $sub3 = $examType === 'GED' ? rand(60,200) : rand(20, 100);
            $sub4 = $examType === 'GED' ? rand(60,200) : rand(20, 100);
            $sub5 = $examType === 'GED' ? 0 : rand(20, 100);
            $sub6 = $examType === 'GED' ? 0 : rand(20, 100);
            
            $totalEduMarks = $sub1 + $sub2 + $sub3 + $sub4 + $sub5 + $sub6;

            DB::table('applicant_records')->insert([
                'applicant_sr' => 'SR' . str_pad($i + 1, 6, '0', STR_PAD_LEFT),
                'mesid' => 'MES' . rand(10000, 99999),
                'email' => 'applicant' . ($i + 1) . '@example.com',
                'current_school' => 'School ' . rand(1, 20),
                'additional_data1' => 'Additional ' . rand(1, 100),
                'additional_data2' => 'Extra ' . rand(1, 100),
                'exam_type' => $examType,
                'sub_1' => $sub1,
                'sub_2' => $sub2,
                'sub_3' => $sub3,
                'sub_4' => $sub4,
                'sub_5' => $sub5,
                'sub_6' => $sub6,
                'total_edu_marks' => $totalEduMarks,
                'program_score' => rand(1, 5),
                'mental_score' => rand(1, 5),
                'essay_score' => rand(1, 5),
                'activity_type' => rand(1, 5),
                'month' => rand(1, 12),
                'activity_score' => rand(1, 6),
                'manual_eligible' => 0
            ]);
        }
    }
}
