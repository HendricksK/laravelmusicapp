<?php

namespace App\Http\Controllers\Classes\Resources;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Interfaces\ExternalInterface;

use GuzzleHttp\Client;

class YoutubeController extends BaseController implements ExternalInterface {

    private static $access_token = null;
    private static $endpoint = 'https://youtube.googleapis.com/youtube/v3/';
    private static $guzzle = null;

    public function __construct() {
        self::$access_token = env('YOUTUBE_APIKEY');
        self::$guzzle = new \GuzzleHttp\Client();
    }
    
    public function init() {
        return true;
    }

    public function isTokenSet() {
        return true;
    }

    public function setAccessToken($access_token) {
        self::$access_token = env('YOUTUBE_APIKEY');
    }

    public function refreshAccessToken() {
        return true;
    }

    public function returnSearchQuery($query) {

        if (empty($query) || empty(self::$access_token)) {
            return json_decode(env('CUTE_ERROR'));
        }

        $response = self::$guzzle->get(
            self::$endpoint . 'search?q=' . $query . '&key=' . self::$access_token, [
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]
        );

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody());
        } else {
            return json_decode(env('CUTE_ERROR'));
        }
        
    }

}
