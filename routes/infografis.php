<?php

use App\Http\Controllers\InfografisController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('infografis', InfografisController::class);
});