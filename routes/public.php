
<?php

use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebController::class, 'index']);
Route::get('/{rubrik}', [WebController::class, 'showCategory'])->name('showCategory');
Route::get('/{rubrik}/{post_id}/{slug}', [WebController::class, 'singlePost'])->name('singlePost');
Route::get('/category/{rubrik_name}', [WebController::class, 'category'])->name('category');
