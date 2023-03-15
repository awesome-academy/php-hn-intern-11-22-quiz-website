<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            )) {
                $token = Auth::user()->createToken('authToken')->accessToken;
            } else {
                return response()->json([
                    'code' => 400,
                    'message' => __('auth.failed'),
                ]);
            }

            return response()->json([
                'code' => 200,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'code' => 500,
                'error' => $ex->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json([
            'message' => __('Logout'),
        ], 200);
    }
}
