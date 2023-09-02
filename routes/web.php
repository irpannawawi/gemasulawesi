<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/browse', [PhotoController::class, 'browse']);

Route::get('/test',[TestController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // assets photo
    Route::get('/photo', [PhotoController::class, 'index'])->name('assets.photo.index');
    Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('assets.photo.upload');
    Route::get('/photo/delete/{id}', [PhotoController::class, 'delete'])->name('assets.photo.delete');
    
    //videos
    Route::get('/video', [VideoController::class, 'index'])->name('assets.video.index');
    Route::get('/video/add', [VideoController::class, 'add'])->name('assets.video.add');
    Route::post('/video', [VideoController::class, 'insert'])->name('assets.video.insert')
    ;
    Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('assets.video.edit');
    Route::put('/video/edit', [VideoController::class, 'update'])->name('assets.video.update');
    Route::get('/video/delete/{id}', [VideoController::class, 'delete'])->name('assets.video.delete');

});

require __DIR__.'/auth.php';
require __DIR__.'/editorial.php';
