<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            $this->clearLoginAttempts($request);

            $http = new Client();
            $response = $http->request('POST', 'http://hrent.ab/oauth/token', [
                'headers' => [
                    'cache-control' => 'no-cache',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'client_id' => $request['client_id'],
                    'client_secret' => $request['client_secret'],
                    'grant_type' => 'password',
                    'username' => $request['email'],
                    'password' => $request['password'],
                    'scope' => '',
                ],
            ]);
            $data['token'] = (object) json_decode((string)$response->getBody());
            $data['user'] = (object) $this->guard()->user();

            return $data;
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
}
