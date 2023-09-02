<?php

use App\Http\Controllers\EditorialContorller;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/editorial/create', [EditorialContorller::class, 'create'])->name('editorial.create');
    Route::get('/editorial/insert', [EditorialContorller::class, 'insert'])->name('editorial.insert');
    Route::get('/editorial/edit', [EditorialContorller::class, 'edit'])->name('editorial.edit');
    Route::get('/editorial/update', [EditorialContorller::class, 'update'])->name('editorial.update');
    Route::get('/editorial/draft', [EditorialContorller::class, 'draft'])->name('editorial.draft');
    Route::get('/editorial/published', [EditorialContorller::class, 'published'])->name('editorial.published');
    Route::get('/editorial/scheduled', [EditorialContorller::class, 'scheduled'])->name('editorial.scheduled');
    Route::get('/editorial/trash', [EditorialContorller::class, 'trash'])->name('editorial.trash');
});