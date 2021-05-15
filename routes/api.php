<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Resources\SpotifyController;
use App\Http\Controllers\Resources\YoutubeController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    return 'hello world';
});

// Spotify Controller Routes
Route::get('/spotify', [SpotifyController::class, 'init']);
// Youtube Controller Routes

Route::get('/youtube', [YoutubeController::class, 'init']);
