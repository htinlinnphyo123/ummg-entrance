<?php

namespace BasicDashboard\Web\ApplicantRecord\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * A ApplicantRecordResource is implement for sending data with requirements of desire template.
 * Generated By Custom Artisan Cmd
 * @author Nay Ba la
 * https://github.com/naybala
 * https://naybala.netlify.app/
 *
 */

class ApplicantRecordResource extends JsonResource
{
    public function toArray($request):array
    {
         return [
            "id" => $this->id,
            "applicant_sr" => $this->applicant_sr,
            "mesid" => $this->mesid,
            "email" => $this->email,
            "current_school" => $this->current_school,
            "additional_data1" => $this->additional_data1,
            "additional_data2" => $this->additional_data2,
            "exam_type" => $this->exam_type,
            "sub_1" => $this->sub_1,
            "sub_2" => $this->sub_2,
            "sub_3" => $this->sub_3,
            "sub_4" => $this->sub_4,
            "sub_5" => $this->sub_5,
            "sub_6" => $this->sub_6,
            "program_score" => $this->program_score,
            "essay_score" => $this->essay_score,
            "mental_score" => $this->mental_score,
            "activity_type" => $this->activity_type,
            "month" => $this->month,
            "activity_score" => $this->activity_score,
            "total_edu_marks" => $this->total_edu_marks,
        ];
    }
}
