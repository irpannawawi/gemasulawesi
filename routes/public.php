
<?php

use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebController::class, 'index']);
// Route::get('/{rubrik}', [WebController::class, 'showCategory'])->name('showCategory');
Route::get('/id/{rubrik}/{post_id}/{slug}', [WebController::class, 'singlePost'])->name('singlePost');
Route::get('/category/{rubrik_name}', [WebController::class, 'category'])->name('category');
Route::get('/tags/{tag_name}', [WebController::class, 'tags'])->name('tags');
Route::get('/search', [WebController::class, 'search'])->name('search');
Route::get('/indeks-berita', [WebController::class, 'indeks'])->name('indeks');
Route::get('/subs', [WebController::class, 'subscribe'])->name('subscribe');
Route::get('/search', [WebController::class, 'search'])->name('search');
