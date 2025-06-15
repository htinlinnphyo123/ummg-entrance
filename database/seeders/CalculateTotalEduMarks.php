<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalculateTotalEduMarks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicants = \DB::table('applicant_records')
            ->select('id', 'sub_1', 'sub_2', 'sub_3', 'sub_4', 'sub_5', 'sub_6')
            ->get();

        foreach ($applicants as $applicant) {
            $total = $applicant->sub_1 + 
                     $applicant->sub_2 + 
                     $applicant->sub_3 + 
                     $applicant->sub_4 + 
                     $applicant->sub_5 + 
                     $applicant->sub_6;

            \DB::table('applicant_records')
                ->where('id', $applicant->id)
                ->update(['total_edu_marks' => $total]);
        }
    }
}
