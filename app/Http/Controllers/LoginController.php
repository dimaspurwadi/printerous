<?php

namespace App\Http\Controllers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Model\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Helpers\JwtHelper;

class LoginController extends BaseController
{
    public function index(Request $req)
    {
        /** set base uri*/
        $currentUrl = url()->current();
        $baseUrl = $this->baseUrl;

        return view(
            'login',
            compact(
                'currentUrl',
                'baseUrl'
            )
        );
    }

    public function store(LoginRequest $req)
    {
        $email = $req->email;
        $password = $req->password;
  
        if (Auth::attempt([
           'email'=> $email,
           'password' => $password
        ])) {
            $user = User::where('email', $email)->first();
            $payload = [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'level' => $user->level,
                'organization_id' => $user->organization_id,
            ];
            $token = (new JwtHelper())->generateToken($payload);
            $user->api_token = $token;
            $user->save();
            $payload['token'] = $token;
            $req->session()->put('data', $payload);
            return redirect()->route('index');
        } else {        
            return redirect()->back()->with('alert', 'Login failed, Email or Password incorrect!');
        }
    }
}
