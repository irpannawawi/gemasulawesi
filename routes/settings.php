<?php

use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/generalSetting', [SettingsController::class, 'index'])->name('setting.general.index');
Route::put('/generalSetting/update', [SettingsController::class, 'update'])->name('setting.general.update');
Route::get('/footersetting', [SettingsController::class, 'footer'])->name('setting.footer.index');
Route::put('/footersetting/update', [SettingsController::class, 'update'])->name('setting.footer.update');
