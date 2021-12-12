<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TweetController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');


Route::group(['middleware'=>'auth:api'], function(){
Route::get('/edit-user/{id}', [UserController::class, 'editUser']);

});

Route::get('/randomtweet',[TweetController::class, 'returnRandomTweet']);
Route::get('/tweets/{id}',[TweetController::class, 'returnTweets']);
