<?php

use App\Http\Controllers\FooterController;
use Illuminate\Support\Facades\Route;

Route::get('/tentang-kami', [FooterController::class, 'about'])->name('tentangkami.index');
Route::get('/kode-etik', [FooterController::class, 'kodeetik'])->name('kodeetik.index');
Route::get('/redaksi', [FooterController::class, 'redaction'])->name('redaksi.index');
Route::get('/kode-perilaku-pers', [FooterController::class, 'kodepers'])->name('kodepers.index');
Route::get('/pedoman-media-siber', [FooterController::class, 'pedoman'])->name('pedoman.index');
Route::get('/perlindungan-data-pengguna', [FooterController::class, 'perlindungan'])->name('perlindungan.index');
Route::get('/lowongan-kerja', [FooterController::class, 'lowongan'])->name('lowongan.index');
Route::get('/extra/{id}', [FooterController::class, 'extra'])->name('extra');
