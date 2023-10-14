<?php

use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/users', [AdministratorController::class, 'index'])->name('users');
    Route::get('/users/{id}', [AdministratorController::class, 'delete'])->name('users.delete');
    Route::post('/users', [AdministratorController::class, 'insert'])->name('users.add');
    Route::put('/users', [AdministratorController::class, 'edit'])->name('users.edit');
});
