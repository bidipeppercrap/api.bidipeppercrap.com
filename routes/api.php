<?php

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

Route::apiResources([
    'posts' => 'PostController',
    'contacts' => 'ContactController',
    'favorites' => 'FavoriteController',
    'wishes' => 'WishController',
    'projects' => 'ProjectController',
    '/' => 'ShowAbout'
]);

Route::post('uploads', 'UploadController@store');

Route::middleware('jwt')->get('/user', function (Request $request) {
    return $request->user();
});
