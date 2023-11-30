<?php

use App\Http\Controllers\FooterController;
use Illuminate\Support\Facades\Route;

Route::get('/tentang-kami', [FooterController::class, 'about'])->name('tentangkami.index');
Route::get('/kode-etik', [FooterController::class, 'kodeetik'])->name('kodeetik.index');
Route::get('/redaksi', [FooterController::class, 'redaction'])->name('redaksi.index');
