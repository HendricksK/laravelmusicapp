<?php

namespace App\Http\Controllers\Resources;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use GuzzleHttp\Client;

class SpotifyController extends BaseController {

    private static $access_token = null;
    private static $endpoint = '';

    public function init() {

        $client_id = env('SPOTIFY_CLIENTID');
        $client_secret = env('SPOTIFY_SECRET');
        // Base encode 64 was breaking encode, save encode .env
        $encodedauth = env('SPOTIFY_ENCODED');

        $guzzle = new \GuzzleHttp\Client();

        $result = $guzzle->post('https://accounts.spotify.com/api/token', [
            'headers' => [
                'Authorization' => 'Basic ' . $encodedauth,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
              'grant_type' => 'client_credentials'
            ],
        ]);

        $data = json_decode($result->getBody());
        self::setAccessToken($data->access_token);
    }

    private static function setAccessToken($access_token) {
        self::$access_token = $access_token;
        return true;
    }

}