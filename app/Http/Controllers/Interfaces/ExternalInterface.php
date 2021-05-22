<?php 

namespace App\Http\Controllers\Interfaces;

interface ExternalInterface {

    public function init();
    public function isTokenSet();
    public function setAccessToken($access_token);
    public function refreshAccessToken();
    public function returnSearchQuery($query);
    
}