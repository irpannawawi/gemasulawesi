<?php

use App\Http\Controllers\HeadlineController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    
    // Headline WP
    Route::get('/wp-headline-management/{id}', [HeadlineController::class, 'wp_headline'])->name('wp-headline-management');
    Route::get('modal.select-article-all', [HeadlineController::class, 'select_all_article'])->name('modal.select-article-all');
    Route::get('/wp-headline-management-change/{rubrik_id}/{post_id}', [HeadlineController::class, 'wp_headline_change'])->name('wp-headline-management-change');
    
    
    
    // Headline Rubrik
    Route::get('/rubrik-headline-management/{id}', [HeadlineController::class, 'rubrik_headline'])->name('rubrik-headline-management');
    Route::get('/rubrik-headline-management-delete/{rubrik_id}', [HeadlineController::class, 'rubrik_headline_delete'])->name('rubrik-headline-management-delete');
    Route::get('/rubrik-headline-management-change/{rubrik_id}/{post_id}', [HeadlineController::class, 'rubrik_headline_change'])->name('rubrik-headline-management-change');

    Route::get('modal.select-article/{rubrik_id}', [HeadlineController::class, 'select_article'])->name('modal.select-article');

    // editor choice
    Route::get('/editor-choice', [HeadlineController::class, 'editor_choice'])->name('editor-choice');
    Route::get('/editor-choice-change/{wpid}/{post_id}', [HeadlineController::class, 'editor_choice_change'])->name('editor-choice-change');
    
    
});