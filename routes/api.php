<?php

use App\Http\Controllers\EditorialController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RubrikController;
use App\Http\Controllers\TagsController;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/rubrik', [RubrikController::class, 'api_list']);
Route::post('/rubrik/insert', [RubrikController::class, 'api_create']);


Route::get('/tag', [TagsController::class, 'api_list']);
Route::post('/tag/insert', [TagsController::class, 'api_create']);
Route::post('/editorial/insert', [EditorialController::class, 'api_create']);
Route::post('/photo/upload', [PhotoController::class, 'upload_api'])->name('assets.photo.upload');
Route::post('/photo/upload_image_only', [PhotoController::class, 'upload_image_only'])->name('assets.photo.upload_image_only');
Route::get('/check_id/{id}', function($id){
    $post = Posts::where('origin_id', $id)->get();
    if($post->count()>0){
        return response()->json(['status'=> 'success','message'=> 'has post']);
    }else{
        return response()->json(['status'=> 'false','message'=> 'post not found']);
    }
})->name('check_id');

Route::get('/posts', function(){
    return response()->json(Posts::select('origin_id')->orderBy('post_id','desc')->get());
});