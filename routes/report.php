<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    // tags management
    Route::get('/report/editor', [ReportController::class, 'editor'])->name('report.editor');
    Route::get('/report/author', [ReportController::class, 'author'])->name('report.author');
    Route::get('/report/author/download', [ReportController::class, 'author_export'])->name('report.author.download');
    Route::get('/report/section', [ReportController::class, 'section'])->name('report.section');
    Route::get('/report/articles', [ReportController::class, 'articles'])->name('report.articles');
    Route::get('/report/articles-user', [ReportController::class, 'articlesUser'])->name('report.articles-user');
});