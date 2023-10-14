<?php

use App\Http\Controllers\BreakingNewsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/breakingNews', [BreakingNewsController::class, 'index'])->name('breakingNews');
    Route::get('/breakingNews-add', [BreakingNewsController::class, 'insert'])->name('breakingNews.add');
    Route::post('/breakingNews-store', [BreakingNewsController::class, 'store'])->name('breakingNews.insert');
    Route::get('/breakingNews-edit/{id}', [BreakingNewsController::class, 'edit'])->name('breakingNews.edit');
    Route::put('/breakingNews-update/{id}', [BreakingNewsController::class, 'update'])->name('breakingNews.update');
    Route::get('/breakingNews-delete/{id}', [BreakingNewsController::class, 'delete'])->name('breakingNews.delete');
});