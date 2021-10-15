<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Cache;
use App\Helpers\JwtHelper;

class BaseController extends Controller
{
    protected $url;
    protected $baseUrl;

    public function __construct(UrlGenerator $url)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->url = $url;
        $this->baseUrl = $this->url->to('/');
        $this->path_app = $_SERVER['DOCUMENT_ROOT'].'/';
    }

    public function getUserToken($request) {
        $token = $request->bearerToken();
        $data = (new JwtHelper())->getTokenDecode($token);
        return $data->data;
    }
}