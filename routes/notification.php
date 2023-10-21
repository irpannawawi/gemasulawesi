<?php

use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\Route;
Route::patch('/subscribe', [PushNotificationController::class, 'subscribe'])->name('subscribe');

Route::middleware('auth')->group(function () {
    Route::get('/pushNotification-send/{id}', [PushNotificationController::class, 'send'])->name('pushNotification.send');
    
    // crud
    Route::get('/pushNotification', [PushNotificationController::class, 'index'])->name('pushNotification.index');
    Route::get('/pushNotification/add', [PushNotificationController::class, 'add'])->name('pushNotification.add');
    Route::post('/pushNotification-store', [PushNotificationController::class, 'store'])->name('pushNotification.insert');
    Route::get('/pushNotification-edit/{id}', [PushNotificationController::class, 'edit'])->name('pushNotification.edit');
    Route::put('/pushNotification-update/{id}', [PushNotificationController::class, 'update'])->name('pushNotification.update');
    Route::get('/pushNotification-delete/{id}', [PushNotificationController::class, 'delete'])->name('pushNotification.delete');
});