<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChannelsController;
use App\Http\Controllers\API\CommentsController;
use App\Http\Controllers\API\SubscriptionsController;
use App\Http\Controllers\API\UploadVideosController;
use App\Http\Controllers\API\VideosController;
use App\Http\Controllers\API\VotesController;
use App\Models\Comment;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:sanctum')->get('/user','App\Http\Controllers\API\AuthController@get_user');

Route::controller(AuthController::class)->group(function (){
    Route::post('login','login');
    Route::post('register','register');
});

Route::controller(ChannelsController::class)->group(function (){
    Route::get('channels/{id}','show');
    Route::post('update_channel/{id}','update_channel');
});


Route::controller(SubscriptionsController::class)->group(function (){
    Route::post('channels/{channel}/subscriptions','store');
    Route::delete('channels/{channel}/subscriptions/{subscription}','destroy');
});

Route::controller(VideosController::class)->group(function (){
    Route::get('videos/{video}','show');
    Route::put('videos/{video}','updateViews');
    Route::post('videos/{video}/update','updateVideo');
});


Route::controller(UploadVideosController::class)->group(function (){
    Route::get('channels/{channel}/videos','index');
    Route::post('channels/{channel}/videos','store');
});


Route::controller(VotesController::class)->group(function (){
    Route::post('votes/{entityId}/{type}','vote');
});

Route::controller(CommentsController::class)->group(function (){
    Route::get('videos/{video}/comments','index');
    Route::get('comments/{comment}/replies','show');
    Route::post('/comments/{video}','store');
});
