<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Model\User;
use Auth;

class IndexController extends BaseController
{
    
    public function index(Request $req)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;
        $dataSession = $req->session()->all();
        
        return view(
            'index',
            compact(
                'currentUrl',
                'baseUrl',
                'dataSession'
            )
        );
    }

}