<?php

namespace BasicDashboard\Foundations\Domain\ApplicantRecord\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Database\Eloquent\Builder;
use BasicDashboard\Foundations\Domain\ApplicantRecord\ApplicantRecord;
use BasicDashboard\Foundations\Domain\Base\Repositories\Eloquent\BaseRepository;
use BasicDashboard\Foundations\Domain\ApplicantRecord\Repositories\ApplicantRecordRepositoryInterface;

class ApplicantRecordRepository extends BaseRepository implements ApplicantRecordRepositoryInterface
{
    public function __construct(ApplicantRecord $model)
    {
        parent::__construct($model);
    }

    public function getApplicantRecordList($params): Collection|LengthAwarePaginator
    {
        $applications = \DB::table('applicant_records')
            ->leftJoin('minimum_eligible_scores', 'minimum_eligible_scores.id', '=', \DB::raw('1'))
            ->select(
                'applicant_records.*',
                \DB::raw('(
                    SELECT eligible_score
                    FROM education_eligible_score
                    WHERE education_eligible_score.exam_type = applicant_records.exam_type
                    AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                    ORDER BY margin_score DESC
                    LIMIT 1
                ) as education_score'),
                \DB::raw("CASE 
                    WHEN (
                        SELECT eligible_score
                        FROM education_eligible_score
                        WHERE education_eligible_score.exam_type = applicant_records.exam_type
                        AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                        ORDER BY margin_score DESC
                        LIMIT 1
                    ) >= minimum_eligible_scores.min_education 
                    THEN 'pass' ELSE 'fail' END as education_eligible"),
                \DB::raw("CASE WHEN applicant_records.mental_score >= minimum_eligible_scores.min_mental THEN 'pass' ELSE 'fail' END as mental_eligible"),
                \DB::raw("CASE WHEN applicant_records.activity_score >= minimum_eligible_scores.min_activity THEN 'pass' ELSE 'fail' END as activity_eligible"),
                \DB::raw("CASE WHEN applicant_records.program_score >= minimum_eligible_scores.min_program THEN 'pass' ELSE 'fail' END as program_eligible"),
                \DB::raw("CASE WHEN applicant_records.essay_score >= minimum_eligible_scores.min_essay THEN 'pass' ELSE 'fail' END as essay_eligible"),
                \DB::raw("(
                    COALESCE((
                        SELECT eligible_score
                        FROM education_eligible_score
                        WHERE education_eligible_score.exam_type = applicant_records.exam_type
                          AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                        ORDER BY margin_score DESC
                        LIMIT 1
                    ), 0) 
                    + applicant_records.essay_score
                    + applicant_records.program_score
                    + applicant_records.activity_score
                ) as total_scores"),
                \DB::raw("CASE 
                    WHEN (
                        (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY education_eligible_score.margin_score DESC
                            LIMIT 1
                        ) IS NULL
                        OR (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY education_eligible_score.margin_score DESC
                            LIMIT 1
                        ) < minimum_eligible_scores.min_education
                        OR applicant_records.mental_score < minimum_eligible_scores.min_mental
                        OR applicant_records.program_score < minimum_eligible_scores.min_program
                        OR applicant_records.essay_score < minimum_eligible_scores.min_essay
                    )
                    THEN 'Not Eligible'
                    ELSE 'Eligible'
                END as final_eligibility")
            )
            ->when($params['exam_type'] ?? false, function ($query) use ($params) {
                $query->where('applicant_records.exam_type', $params['exam_type']);
            })
            ->when($params['sort_eligible'] ?? false, function ($query) {
                $query->orderByRaw("
                    CASE 
                        WHEN final_eligibility = 'Eligible' THEN 1
                        WHEN final_eligibility = 'Not Eligible' AND manual_eligible = 1 THEN 2 
                        ELSE 3
                    END
                ");
            })
            ->orderBy('total_scores', 'desc')
            ->paginate(request()->get('paginate', 30));
        return $applications;
    }

    public function getCount($params)    
    {
        return \DB::table('applicant_records')
            ->leftJoin('minimum_eligible_scores', 'minimum_eligible_scores.id', '=', \DB::raw('1'))
            ->selectRaw("
                COUNT(CASE 
                    WHEN (
                        (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY margin_score DESC
                            LIMIT 1
                        ) >= minimum_eligible_scores.min_education
                        AND applicant_records.mental_score >= minimum_eligible_scores.min_mental
                        AND applicant_records.program_score >= minimum_eligible_scores.min_program
                        AND applicant_records.essay_score >= minimum_eligible_scores.min_essay
                    ) THEN 1 END) as eligible_count,

                COUNT(CASE 
                    WHEN (
                        (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY margin_score DESC
                            LIMIT 1
                        ) IS NULL
                        OR (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY margin_score DESC
                            LIMIT 1
                        ) < minimum_eligible_scores.min_education
                        OR applicant_records.mental_score < minimum_eligible_scores.min_mental
                        OR applicant_records.program_score < minimum_eligible_scores.min_program
                        OR applicant_records.essay_score < minimum_eligible_scores.min_essay
                    ) AND manual_eligible = 1 THEN 1 END) as manual_eligible_count,

                COUNT(CASE 
                    WHEN (
                        (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY margin_score DESC
                            LIMIT 1
                        ) IS NULL
                        OR (SELECT eligible_score
                            FROM education_eligible_score
                            WHERE education_eligible_score.exam_type = applicant_records.exam_type
                            AND education_eligible_score.margin_score <= applicant_records.total_edu_marks
                            ORDER BY margin_score DESC
                            LIMIT 1
                        ) < minimum_eligible_scores.min_education
                        OR applicant_records.mental_score < minimum_eligible_scores.min_mental
                        OR applicant_records.program_score < minimum_eligible_scores.min_program
                        OR applicant_records.essay_score < minimum_eligible_scores.min_essay
                    ) AND manual_eligible != 1 THEN 1 END) as not_eligible_count
            ")
            ->when($params['exam_type'] ?? false, function ($query) use ($params) {
                $query->where('applicant_records.exam_type', $params['exam_type']);
            })
            ->first();
    }
}
