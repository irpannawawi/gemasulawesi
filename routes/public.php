
<?php

use App\Http\Controllers\HeadlineController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebController::class, 'index']);
Route::get('/single-post', [WebController::class, 'singlePost']);
Route::get('/{rubrik}', [WebController::class, 'showCategory']);
Route::get('/{rubrik}/{post_id}', [WebController::class, 'singlePost'])->name('singlePost');
