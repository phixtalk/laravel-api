<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $token = $user->createToken('admin')->accessToken;

            $cookie = cookie('jwt', $token, 3600);

            return response([
                'token' => $token
            ])->withCookie($cookie);
        }

        return response([
            'token' => 'Invalid Credentials!'
        ], Response::HTTP_UNAUTHORIZED);

        /**
         * Also update supports_credentials to true in config/cors.php
         * 
         * Now even though we are sending the cookie from the frontend, 
         * We need laravel Passport to use it
         * So we have to fake how to set the bearer token via the cookie
         */
    }

    public function logout()
    {

        $cookie = cookie()->forget('jwt');

        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email') + [
                'password' => Hash::make($request->input('password')),
				'role_id' => 1,
            ]
        );

        return response($user, Response::HTTP_CREATED);
    }
}
