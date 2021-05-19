<?php

namespace App\Http\Controllers\Resources;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Resources\ExternalApi;

use GuzzleHttp\Client;

class SpotifyController extends BaseController implements ExternalApi {

    private static $access_token = null;
    private static $endpoint = 'https://accounts.spotify.com/api/token';
    private static $encodedauth = '';
    private static $guzzle = null;

    public function __construct() {
        self::$encodedauth = env('SPOTIFY_ENCODED');
        self::$guzzle = new \GuzzleHttp\Client();
    }

    public function init() {

        $result = self::$guzzle->post(self::$endpoint, [
            'headers' => [
                'Authorization' => 'Basic ' . self::$encodedauth,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
              'grant_type' => 'client_credentials'
            ],
        ]);

        $data = json_decode($result->getBody());
        $this->setAccessToken($data->access_token);
        // Check if token is set.
        return $this->isTokenSet();
    }

    public function setAccessToken($access_token) {
        self::$access_token = $access_token;
        return true;
    }

    public function refreshAccessToken() {
        
        $access_token = self::$access_token;

        if (empty($access_token)) {
            return $this->init();
        }

        $result = self::$guzzle->post(self::$endpoint, [
            'headers' => [
                'Authorization' => 'Basic ' . self::$encodedauth,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
              'grant_type' => 'refresh_token',
              'refresh_token' => $access_token
            ],
        ]);

        $data = json_decode($result->getBody());
        $this->setAccessToken($data->access_token);
        // Check if token is set.
        return $this->isTokenSet();
    }

    public function isTokenSet() {
        if (!empty(self::$access_token)) {
            return true;
        }
        return false;
    }

    public function returnSearchQuery($query) {

    }

}