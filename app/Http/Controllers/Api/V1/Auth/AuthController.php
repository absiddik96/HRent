<?php

namespace App\Http\Controllers\Api\V1\Auth;

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

            $user = $this->guard()->user();

            // Revoke Previous Token
            $this->loggedOut();

            $form_params = [
                'client_id' => $request['client_id'],
                'client_secret' => $request['client_secret'],
                'grant_type' => 'password',
                'username' => $request['email'],
                'password' => $request['password'],
            ];

            if ($user->user_role == 'admin') {
                $form_params['scope'] = 'admin';
            } elseif ($user->user_role == 'landlord') {
                $form_params['scope'] = 'landlord';
            } elseif ($user->user_role == 'renter') {
                $form_params['scope'] = 'renter';
            }

            $http = new Client();
            $response = $http->request('POST', 'http://hrent.ab/oauth/token', [
                'headers' => [
                    'cache-control' => 'no-cache',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => $form_params,
            ]);
            $data['token'] = (object)json_decode((string)$response->getBody());
            unset($user->tokens);
            $data['user'] = (object)$user;

            return $data;
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function loggedOut()
    {
        $user = request()->user('api');
        if($user) {
            if ($user->tokens->count()) {
                $user->tokens->each(function ($token, $key) {
                    $token->delete();
                });
            }
            return response()->json(['success' => 'Logout successfully']);
        }else{
            return response()->json(['message' => 'Unauthenticated']);
        }
    }
}
