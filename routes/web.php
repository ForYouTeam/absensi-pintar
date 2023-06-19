<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);