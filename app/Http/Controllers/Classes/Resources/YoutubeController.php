<?php

namespace App\Http\Controllers\Classes\Resources;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class YoutubeController extends BaseController {
    
    public function init() {
        return 'Youtube';
    }
}
