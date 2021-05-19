<?php 

namespace App\Http\Controllers\Resources;

interface ExternalApi {

    public function init();
    public function isTokenSet();
    public function setAccessToken($access_token);
    public function refreshAccessToken();
    public function returnSearchQuery($search_query);
    
}