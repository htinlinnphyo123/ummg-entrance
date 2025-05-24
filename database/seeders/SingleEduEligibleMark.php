<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SingleEduEligibleMark extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->generateEligiblityScore();
        foreach ($data as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('single_edu_eligible_marks')->insert($item);
        }
    }

    protected function generateEligiblityScore(): array
    {
        return [
            [
                'exam_type' => 'BEHS',
                'sub_1' => 40,
                'sub_2' => 60,
                'sub_3' => 62,
                'sub_4' => 65,
                'sub_5' => 65,
                'sub_6' => 65,
            ],[
                'exam_type' => 'BECA',
                'sub_1' => 3,
                'sub_2' => 3,
                'sub_3' => 3,
                'sub_4' => 3,
                'sub_5' => 3,
                'sub_6' => 3,
            ],[
                'exam_type' => 'GED',
                'sub_1' => 145,
                'sub_2' => 145,
                'sub_3' => 145,
                'sub_4' => 145,
                'sub_5' => 0,
                'sub_6' => 0
            ],[
                'exam_type' => 'IGCSE',
                'sub_1' => 3,
                'sub_2' => 3,
                'sub_3' => 3,
                'sub_4' => 3,
                'sub_5' => 3,
                'sub_6' => 3,
            ]
        ];
    }

}
