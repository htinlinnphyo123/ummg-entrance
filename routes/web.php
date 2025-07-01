<?php

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use BasicDashboard\Web\Auth\Controllers\AuthController;
use BasicDashboard\Web\Users\Controllers\UserController;
use BasicDashboard\Web\Dashboard\Controllers\DashboardController;
use BasicDashboard\Web\ApplicantRecord\Controllers\ApplicantRecordController;
use BasicDashboard\Web\MinimumEligibleScore\Controllers\MinimumEligibleScoreController;
use BasicDashboard\Web\SingleEduEligibleMarks\Controllers\SingleEduEligibleMarkController;
use BasicDashboard\Web\EducationEligibleScores\Controllers\EducationEligibleScoreController;

Route::get('optimize-hey-yo', function () {
    Artisan::call('optimize:clear');
    return redirect('/');
});

require __DIR__ . "/Web/Guest/guestRoute.php";
require __DIR__ . "/Web/Localization/localizationRoute.php";

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    require __DIR__ . "/Web/User/userRoute.php";
    Route::resource('singleEduEligibleMarks' ,SingleEduEligibleMarkController::class)->only('index','edit','show','update');
    Route::resource('educationEligibleScores',EducationEligibleScoreController::class);
    Route::resource('minimumEligibleScores',MinimumEligibleScoreController::class);
    Route::resource('applicantRecords' ,ApplicantRecordController::class);
    Route::post('/applicantRecords/{id}/manual-eligible', [ApplicantRecordController::class, 'manualEligible'])->name('applicantRecords.manualEligible');
    Route::patch('/applicantRecords/{id}/update-final-take', [ApplicantRecordController::class, 'updateFinalTake'])->name('applicantRecords.updateFinalTake');
});
Route::put('update-final-take-record-setting', function() {
    $setting = Setting::where('key', 'allow_toggle_final_take')->first();
    if ($setting) {
        $setting->value = $setting->value == 1 ? 0 : 1;
        $setting->save();
        return back()->with('success', 'Setting updated successfully');
    }
    return back()->with('error', 'Setting not found');
})->name('applicantRecords.toggleFinalTake');
Route::get('/profile', [UserController::class, 'profile'])->name('userProfile')->middleware('auth');

Route::get('hello',function(){
    echo phpinfo();
});