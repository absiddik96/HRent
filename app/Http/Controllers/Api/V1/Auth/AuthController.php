<?php

namespace App\Http\Controllers\Api\V1\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client();
        
        $response = $http->request('POST', 'http://hrent.ab/oauth/token', [
            'headers' => [
                'cache-control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'client_id' => $request['client_id'],
                'client_secret' => $request['client_secret'],
                'grant_type' => 'password',
                'username' => $request['username'],
                'password' => $request['password'],
                'scope' => '',
            ],
        ]);
        
        return json_decode((string) $response->getBody(), true);
    }
}
