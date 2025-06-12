<?php
namespace BasicDashboard\Foundations\Domain\ApplicantRecord\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Database\Eloquent\Builder;
use BasicDashboard\Foundations\Domain\ApplicantRecord\ApplicantRecord;
use BasicDashboard\Foundations\Domain\Base\Repositories\BaseRepositoryInterface;

interface ApplicantRecordRepositoryInterface extends BaseRepositoryInterface
{
    public function getApplicantRecordList($params): Collection|LengthAwarePaginator;
    public function getCount($params);

}