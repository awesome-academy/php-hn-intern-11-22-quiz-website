<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

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

    public function register(RegisterRequest $request)
    {
        try {
            $this->userRepo->create([
                'username' => $request->username,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password),
                'role_id' => User::ROLE_USER,
            ]);

            return response()->json([
                'code' => 200,
                'message' => __('Register Successfully'),
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
