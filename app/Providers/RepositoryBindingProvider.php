<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BasicDashboard\Foundations\Domain\Users\Repositories\Eloquent\UserRepository;
use BasicDashboard\Foundations\Domain\Users\Repositories\UserRepositoryInterface;
use BasicDashboard\Foundations\Domain\MinimumEligibleScore\Repositories\Eloquent\MinimumEligibleScoreRepository;
use BasicDashboard\Foundations\Domain\MinimumEligibleScore\Repositories\MinimumEligibleScoreRepositoryInterface;
use BasicDashboard\Foundations\Domain\SingleEduEligibleMarks\Repositories\Eloquent\SingleEduEligibleMarkRepository;
use BasicDashboard\Foundations\Domain\SingleEduEligibleMarks\Repositories\SingleEduEligibleMarkRepositoryInterface;
use BasicDashboard\Foundations\Domain\EducationEligibleScores\Repositories\EducationEligibleScoreRepositoryInterface;
use BasicDashboard\Foundations\Domain\EducationEligibleScores\Repositories\Eloquent\EducationEligibleScoreRepository;

class RepositoryBindingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);        
        $this->app->bind(SingleEduEligibleMarkRepositoryInterface::class,SingleEduEligibleMarkRepository::class);
        $this->app->bind(EducationEligibleScoreRepositoryInterface::class,EducationEligibleScoreRepository::class);
        $this->app->bind(MinimumEligibleScoreRepositoryInterface::class,MinimumEligibleScoreRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
