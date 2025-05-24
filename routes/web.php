<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use BasicDashboard\Web\Auth\Controllers\AuthController;
use BasicDashboard\Web\Users\Controllers\UserController;
use BasicDashboard\Web\Dashboard\Controllers\DashboardController;

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

});
Route::get('/profile', [UserController::class, 'profile'])->name('userProfile')->middleware('auth');

Route::get('hello',function(){
    echo phpinfo();
});