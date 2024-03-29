
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
Route::get('/', [WebController::class, 'index']);
Route::get('/id/{rubrik}/{post_id}/{slug}', [WebController::class, 'singlePost'])
    ->where('rubrik', '[\w\s-]+')
    ->name('singlePost');
Route::get('/category/{rubrik_name}', [WebController::class, 'category'])->name('category');
Route::get('/tags/{tag_name}', [WebController::class, 'tags'])->name('tags');
Route::get('/tag/{tag_name}',function($tag_name){
    return Redirect::to('/tags/'.$tag_name);
})->name('old-tags');
Route::get('/search', [WebController::class, 'search'])->name('search');
Route::get('/indeks-berita', [WebController::class, 'indeks'])->name('indeks');
Route::get('/search', [WebController::class, 'search'])->name('search');
Route::get('/topik-khusus/detail/{topic_id}/{slug}', [WebController::class, 'topikkhusus'])->name('topikkhusus');
Route::get('/subs', [WebController::class, 'subscribe'])->name('subscribe');
Route::get('/gallery', [WebGalleryController::class, 'gallery'])->name('gallery');
Route::get('/author/{id}/{name}', [WebController::class, 'author'])->name('author');
Route::get('/tags/{id}/{name}', [WebController::class, 'editor'])->name('editor');
Route::get('/galery/detail/{galery_id}/{galery_name}', [WebGalleryController::class, 'galerydetail'])->name('galerydetail');
Route::get('/sitemap_news.xml', [WebController::class, 'news_xml'])->name('newsXml');
