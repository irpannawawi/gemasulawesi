<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
Route::middleware('auth')->group(function () {
    Route::resource('ads', AdController::class); 
    Route::get('/ads/create/big_hero', [AdController::class, 'create_big_hero'])->name('ads.create_big_hero');
    Route::get('/ads/load_page/{page}', [AdController::class, 'load_page'])->name('ads.load_page');
    Route::post('/ads/store', [AdController::class, 'store'])->name('ads.store');
    Route::post('/ads/store/script', [AdController::class, 'store_script'])->name('ads.store_script');
    Route::get('/ads/delete/{ad}', [AdController::class, 'destroy'])->name('ads.delete');
    
    
    Route::get('/ads/clear/big_hero', [AdController::class, 'clear_big_hero'])->name('ads.clear_big_hero');

    Route::get('/ads/create/script', [AdController::class, 'create_script'])->name('ads.create_script');
    Route::get('/ads/edit/script/{ad}', [AdController::class, 'edit_script'])->name('ads.edit_script');
    Route::put('/ads/update/script/{ad}', [AdController::class, 'update_script'])->name('ads.update_script');
});