<?php

use Illuminate\Support\Facades\Route;
use BasicDashboard\Spa\ContactForm\Controllers\ContactFormController;

Route::prefix('v1/spa')->middleware(['accept.json'])->group(function () {
    // require __DIR__ . "/Spa/Category/categoryApi.php";
});