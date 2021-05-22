<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Classes\Resources\SpotifyController;
use App\Http\Controllers\Classes\Resources\YoutubeController;

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
Route::prefix('spotify')->group(function () {
    Route::get('/init', [SpotifyController::class, 'init']);
    Route::get('/search', function(Request $request) {
        $sc = new SpotifyController();
        $data['_artist'] = $sc->returnSearchQuery($request->query('q'));
        $data['_track'] = $sc->returnSearchQuery($request->query('q'), 'track');
        return json_encode($data);
    });
});

// Youtube Controller Routes
// 
Route::prefix('youtube')->group(function () {
    Route::get('/init', [YoutubeController::class, 'init']);
});
