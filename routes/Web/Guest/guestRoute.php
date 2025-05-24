<?php


use Illuminate\Support\Facades\Route;
use BasicDashboard\Web\Auth\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('unauthorize');
Route::post('/login', [AuthController::class, 'authorizeOperator']);

