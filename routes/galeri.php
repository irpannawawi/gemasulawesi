<?php

use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/galeri', [GaleriController::class, 'galeri'])->name('galeri');
    Route::get('/galeri/{id}', [GaleriController::class, 'delete'])->name('galeri.delete');
    Route::post('/galeri', [GaleriController::class, 'insert'])->name('galeri.add');
    Route::put('/galeri', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::get('/galeri/view/{id}', [GaleriController::class, 'collection'])->name('galeri.view');
    Route::post('/galeri/collection-insert', [GaleriController::class, 'collection_insert'])->name('galeri.collection.insert');
    Route::get('/galeri/collection-delete/{id}', [GaleriController::class, 'collection_delete'])->name('galeri.collection.delete');
});
