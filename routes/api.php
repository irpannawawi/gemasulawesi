<?php

use App\Http\Controllers\EditorialController;
use App\Http\Controllers\RubrikController;
use App\Http\Controllers\TagsController;
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
