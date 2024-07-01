<?php

use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebGalleryController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return Redirect::to('/');
});


Route::get('/', [WebController::class, 'index'])->middleware('visitor.counter');

Route::get('/id/{rubrik}/{post_id}/{slug}', [WebController::class, 'singlePost'])
    ->where('rubrik', '[\w\s-]+')
    ->name('singlePost')
    ->middleware(['removePageOne', 'visitor.counter']);

Route::get('/category/{rubrik_name}', [WebController::class, 'category'])->name('category')->middleware(['removePageOne', 'visitor.counter']);

Route::get('/tags/{tag_name}', [WebController::class, 'tags'])->name('tags')->middleware(['removePageOne', 'visitor.counter']);

Route::get('/tag/{tag_name}', function ($tag_name) {
    return Redirect::to('/tags/' . $tag_name);
})->name('old-tags')->middleware('visitor.counter');

Route::get('/search', [WebController::class, 'search'])->name('search')->middleware(['removePageOne', 'visitor.counter']);

Route::get('/indeks-berita', [WebController::class, 'indeks'])->name('indeks')->middleware(['removePageOne', 'visitor.counter']);

Route::get('/topik-khusus/detail/{topic_id}/{slug}', [WebController::class, 'topikkhusus'])->name('topikkhusus')->middleware('visitor.counter');

Route::get('/subs', [WebController::class, 'subscribe'])->name('subscribe');

Route::get('/gallery', [WebGalleryController::class, 'gallery'])->name('gallery')->middleware('visitor.counter');

Route::get('/author/{id}/{name}', [WebController::class, 'author'])->name('author')->middleware(['removePageOne', 'visitor.counter']);

Route::get('/tags/{id}/{name}', [WebController::class, 'editor'])->name('editor')->middleware('visitor.counter');

Route::get('/galery/detail/{galery_id}/{galery_name}', [WebGalleryController::class, 'galerydetail'])->name('galerydetail')->middleware('visitor.counter');
Route::get('/sitemap_news.xml', [WebController::class, 'news_xml'])->name('newsXml');