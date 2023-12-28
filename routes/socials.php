<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\XController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    // facebook & ig
    Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('socials.facebook.auth');
    Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback'])->name('socials.facebook.callback');
    Route::get('/auth/facebook/addPages', [FacebookController::class, 'addPages'])->name('socials.facebook.addPages');
    Route::post('/auth/facebook/addPages', [FacebookController::class, 'insertPages'])->name('socials.facebook.insertPages');
    Route::get('/auth/facebook/logout', [FacebookController::class, 'handleLogout'])->name('socials.facebook.disconnect');
    
    // x twitter
    Route::get('x/auth', [XController::class,'x_auth'])->name('socials.x.auth');
    Route::get('x/callback', [XController::class,'x_callback'])->name('socials.x.callback');
    Route::get('x/logout', [XController::class,'x_logout'])->name('socials.x.disconnect');
    
});