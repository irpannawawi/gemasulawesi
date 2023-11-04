<?php

use App\Http\Controllers\EditorialController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
// Route::post('/editorial/insert', [EditorialController::class, 'api_create']);

Route::middleware('auth')->group(function () {
    Route::get('/editorial/create', [EditorialController::class, 'create'])->name('editorial.create');
    Route::get('/editorial/edit', [EditorialController::class, 'edit'])->name('editorial.edit');
    Route::get('/editorial/update', [EditorialController::class, 'update'])->name('editorial.update');
    Route::get('/editorial/draft', [EditorialController::class, 'draft'])->name('editorial.draft');
    Route::get('/editorial/published', [EditorialController::class, 'published'])->name('editorial.published');
    Route::get('/editorial/scheduled', [EditorialController::class, 'scheduled'])->name('editorial.scheduled');
    Route::get('/editorial/trash', [EditorialController::class, 'trash'])->name('editorial.trash');
    
    
});