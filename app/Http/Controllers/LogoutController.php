<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends BaseController
{
    public function index(Request $req)
    {
        Auth::logout();
        return redirect()->route('login');
    }

}