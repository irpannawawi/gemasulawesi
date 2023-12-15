<?php

use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/nav', [NavigationController::class, 'index'])->name('nav');
    Route::get('/nav/list_rubrik/{id}', [NavigationController::class, 'list_rubrik'])->name('nav.getListRubrik');
    Route::post('/nav', [NavigationController::class, 'insert'])->name('nav.add');
    Route::post('/nav/addrubrik', [NavigationController::class, 'insert_rubrik'])->name('nav.addRubrik');
    Route::get('/nav/{id}', [NavigationController::class, 'delete'])->name('nav.delete');
    Route::put('/nav/update', [NavigationController::class, 'update'])->name('nav.update');
    Route::get('/nav/up/{id}', [NavigationController::class, 'change_order_up'])->name('nav.up');
    Route::get('/nav/down/{id}', [NavigationController::class, 'change_order_down'])->name('nav.down');
});
