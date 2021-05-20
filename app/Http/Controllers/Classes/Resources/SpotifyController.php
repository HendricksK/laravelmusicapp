<?php

namespace App\Http\Controllers\Classes\Resources;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Interfaces\ExternalInterface;

use GuzzleHttp\Client;

class SpotifyController extends BaseController implements ExternalInterface {

    private static $access_token = null;
    private static $authendpoint = 'https://accounts.spotify.com/api/token';
    private static $endpoint = 'https://api.spotify.com/v1/';
    private static $encoded_auth = '';
    private static $guzzle = null;

    /**
     * __construct
     * constructor
     */
    public function __construct() {
        self::$encoded_auth = env('SPOTIFY_ENCODED');
        self::$guzzle = new \GuzzleHttp\Client();
    }

    /**
     * function init()
     * @return bool
     */
    public function init() {

        $result = self::$guzzle->post(self::$authendpoint, [
            'headers' => [
                'Authorization' => 'Basic ' . self::$encoded_auth,
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

    /**
     * function setAccessToken()
     * @param $access_token
     * @return bool
     */
    public function setAccessToken($access_token) {
        self::$access_token = $access_token;
        return true;
    }

    /**
     * function refreshAccessToken()
     * @return bool
     */
    public function refreshAccessToken() {
        
        // $access_token = self::$access_token;

        // if (empty($access_token)) {
        //     return $this->init();
        // }

        // $result = self::$guzzle->post(self::$authendpoint, [
        //     'headers' => [
        //         'Authorization' => 'Basic ' . self::$encoded_auth,
        //         'Content-Type' => 'application/x-www-form-urlencoded',
        //     ],
        //     'form_params' => [
        //       'grant_type' => 'refresh_token',
        //       'refresh_token' => $access_token
        //     ],
        // ]);

        // $data = json_decode($result->getBody());
        // $this->setAccessToken($data->access_token);
        // Check if token is set.
        // return $this->isTokenSet();
    }

    /**
     * function isTokenSet()
     * Checks to see whether current spotify token is set.
     * @return bool
     */
    public function isTokenSet() {
        if (!empty(self::$access_token)) {
            return true;
        }
        return false;
    }

    /**
     * functon returnSearchQuery()
     * @param $query, search query being passed onto API request
     * @return array
     */
    public function returnSearchQuery($query, $type = '') {

        $query_type = 'artist';

        $this->init();

        self::$access_token;

        if ($type) {
            $query_type = $type;
        }

        $result = self::$guzzle->get(
            self::$endpoint . 'search?q=' . $query . '&type=' . $query_type, [
                'headers' => [
                    'Authorization' => 'Bearer ' . self::$access_token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]
        );

        return json_decode($result->getBody());

    }

}