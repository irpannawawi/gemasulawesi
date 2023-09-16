<?php

use App\Http\Controllers\BrowseController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RubrikController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WebController;
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

Route::get('/', [WebController::class, 'index']);

Route::get('/browse', [PhotoController::class, 'browse']);
Route::get('/browse_baca_juga', [BrowseController::class, 'browseBacaJuga']);

Route::get('/test', [TestController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // rubrik management
    Route::get('/rubrik', [RubrikController::class, 'index'])->name('rubrik.index');
    Route::post('/rubrik_add', [RubrikController::class, 'insert'])->name('rubrik.add');
    Route::put('/rubrik_edit', [RubrikController::class, 'edit'])->name('rubrik.edit');
    Route::get('/rubrik_delete/{id}', [RubrikController::class, 'delete'])->name('rubrik.delete');

    // tags management
    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::post('/tags_add', [TagsController::class, 'insert'])->name('tags.add');
    Route::put('/tags_edit', [TagsController::class, 'edit'])->name('tags.edit');
    Route::get('/tags_delete/{id}', [TagsController::class, 'delete'])->name('tags.delete');
    // modals
    Route::get('/modal_tags', [TagsController::class, 'modal_tags'])->name('modal.tags');

    

    // assets photo
    Route::get('/photo', [PhotoController::class, 'index'])->name('assets.photo.index');
    Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('assets.photo.upload');
    Route::get('/photo/delete/{id}', [PhotoController::class, 'delete'])->name('assets.photo.delete');

    //videos
    Route::get('/video', [VideoController::class, 'index'])->name('assets.video.index');
    Route::get('/video/add', [VideoController::class, 'add'])->name('assets.video.add');
    Route::post('/video', [VideoController::class, 'insert'])->name('assets.video.insert');
    Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('assets.video.edit');
    Route::put('/video/edit', [VideoController::class, 'update'])->name('assets.video.update');
    Route::get('/video/delete/{id}', [VideoController::class, 'delete'])->name('assets.video.delete');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/editorial.php';
