<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RubrikController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TopicController;
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

// test queue
use App\Models\Posts;
use App\Http\Controllers\SitemapController;
use App\Jobs\BroadcastNews;
use App\Models\Subscriber;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Messaging\CloudMessage;

Route::get('/sitemap', [SitemapController::class, 'generate']);
// Route::get('/push', function(){
//     $res = BroadcastNews::dispatch(2)->onQueue('schedule_broadcast')->delay(now()->addMinutes(1));
    
// });

// route editorial
Route::get('/browse', [PhotoController::class, 'browse'])->name('browseImage');
Route::get('/browse_edit_image/{id}/{source}', [PhotoController::class, 'browse_edit_image'])->name('browseEditImage');
Route::get('/browse_baca_juga', [BrowseController::class, 'browseBacaJuga']);
Route::post('/create_img_byTinymce', [PhotoController::class, 'update_image_tinymce'])->name('assets.photo.updateTinymce');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile', [AdministratorController::class, 'profile'])->name('profile');
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

    // source management
    Route::get('/source', [SourceController::class, 'index'])->name('sources.index');
    Route::post('/source_add', [SourceController::class, 'insert'])->name('sources.add');
    Route::put('/source_edit', [SourceController::class, 'edit'])->name('sources.edit');
    Route::get('/source_delete/{id}', [SourceController::class, 'delete'])->name('sources.delete');
    // modals
    Route::get('/modal_source', [SourceController::class, 'modal_source'])->name('modal.source');


    // TOPICS management
    Route::get('/topic', [TopicController::class, 'index'])->name('topics.index');
    Route::post('/topic_add', [TopicController::class, 'insert'])->name('topics.add');
    Route::put('/topic_edit', [TopicController::class, 'edit'])->name('topics.edit');
    Route::get('/topic_delete/{id}', [TopicController::class, 'delete'])->name('topics.delete');
    // modals
    Route::get('/modal_topic', [TopicController::class, 'modal_topic'])->name('modal.topic');

    // related articles
    Route::get('/modal_related', [EditorialController::class, 'modal_related'])->name('modal.related');

    // assets photo
    Route::get('/photo', [PhotoController::class, 'index'])->name('assets.photo.index');
    Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('assets.photo.upload');
    Route::get('/photo/edit/{id}', [PhotoController::class, 'edit'])->name('assets.photo.edit');
    Route::put('/photo/update', [PhotoController::class, 'update'])->name('assets.photo.update');
    Route::get('/photo/delete/{id}', [PhotoController::class, 'delete'])->name('assets.photo.delete');
    Route::post('/photo/browse/upload', [PhotoController::class, 'browse_upload'])->name('assets.photo.browse.upload');
    Route::get('/photo/browse/delete/{id}', [PhotoController::class, 'browse_delete'])->name('assets.photo.browse.delete');

    //videos
    Route::get('/videos', [VideoController::class, 'index'])->name('assets.video.index');
    Route::get('/video/add', [VideoController::class, 'add'])->name('assets.video.add');
    Route::post('/video', [VideoController::class, 'insert'])->name('assets.video.insert');
    Route::get('/video/edit/{id}', [VideoController::class, 'edit'])->name('assets.video.edit');
    Route::put('/video/edit', [VideoController::class, 'update'])->name('assets.video.update');
    Route::get('/video/delete/{id}', [VideoController::class, 'delete'])->name('assets.video.delete');
});


Route::get('/errors', function () {
    return view('errors.404');
})->name('error');

require __DIR__ . '/public.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/ads.php';
require __DIR__ . '/administrator.php';
require __DIR__ . '/editorial.php';
require __DIR__ . '/galeri.php';
require __DIR__ . '/breakingNews.php';
require __DIR__ . '/notification.php';
require __DIR__ . '/report.php';
require __DIR__ . '/web-management.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/menufooter.php';
require __DIR__ . '/navigation.php';
require __DIR__ . '/amp.php';


Route::get('count_post', function () {
    $data = [
        'post' => Posts::all()->count(),
    ];
    return view('count_post', $data);
});

Route::get('/{slug}', function($slug){
    $post = Posts::where('slug', $slug)->first();
    if($post){

        return redirect()->route('singlePost', [
            'rubrik'=>$post->rubrik->rubrik_name,
            'post_id'=>$post->post_id,
            'slug'=>$post->slug,
        ]);
    }else{
        return abort(404);
    }
});