
<?php

use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\WebAmpController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/amp', [WebAmpController::class, 'index']);
Route::get('/id/{rubrik}/amp/{post_id}/{slug}', [WebAmpController::class, 'singlePost'])
    ->where('rubrik', '[\w\s-]+')
    ->name('ampSinglePost');
// Route::get('/category/{rubrik_name}', [WebController::class, 'category'])->name('category');
// Route::get('/tags/{tag_name}', [WebController::class, 'tags'])->name('tags');
// Route::get('/search', [WebController::class, 'search'])->name('search');
// Route::get('/indeks-berita', [WebController::class, 'indeks'])->name('indeks');
// Route::get('/search', [WebController::class, 'search'])->name('search');
// Route::get('/topik-khusus/detail/{topic_id}/{slug}', [WebController::class, 'topikkhusus'])->name('topikkhusus');
// Route::get('/subs', [WebController::class, 'subscribe'])->name('subscribe');
