<?php

namespace App\Http\Controllers\Classes\Resources;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use GuzzleHttp\Client;

class YoutubeController extends BaseController implements ExternalInterface {

    private static $access_token = null;
    private static $authendpoint = 'https://accounts.spotify.com/api/token';
    private static $endpoint = 'https://api.spotify.com/v1/';
    private static $encoded_auth = '';
    private static $guzzle = null;

    public function __contruct() {

    }
    
    public function init() {
        return 'Youtube';
    }

    public function isTokenSet();
    public function setAccessToken($access_token);
    public function refreshAccessToken();
    public function returnSearchQuery($search_query);

}
