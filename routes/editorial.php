<?php

use App\Http\Controllers\EditorialController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/editorial/insert', [EditorialController::class, 'insert'])->name('editorial.insert');
    Route::get('/editorial/create', [EditorialController::class, 'create'])->name('editorial.create');
    Route::get('/editorial/edit/{id}', [EditorialController::class, 'edit'])->name('editorial.edit');
    Route::post('/editorial/update/{id}', [EditorialController::class, 'update'])->name('editorial.update');
    Route::get('/editorial/draft', [EditorialController::class, 'draft'])->name('editorial.draft');
    Route::get('/editorial/published', [EditorialController::class, 'published'])->name('editorial.published');
    Route::get('/editorial/scheduled', [EditorialController::class, 'scheduled'])->name('editorial.scheduled');
    Route::get('/editorial/trash', [EditorialController::class, 'trash'])->name('editorial.trash');
    Route::get('/editorial/delete/{id}', [EditorialController::class, 'delete'])->name('editorial.delete');
    Route::get('/editorial/restore/{id}', [EditorialController::class, 'restore'])->name('editorial.restore');
    Route::get('/editorial/hardDelete/{id}', [EditorialController::class, 'HardDelete'])->name('editorial.hardDelete');
    Route::get('/editorial/trash/empty', [EditorialController::class, 'empty_trash'])->name('editorial.emptyTrash');
    
    
});