<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('accessToken')->plainTextToken;

        return response()->success(
            [
                'token' => $token,
                'user' => $user
            ],
            'User registered successfully',
            Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request)
    {
        // Authenticate the user via LoginRequest
        $request->authenticate();

        // Create a token for the user
        $token = $request->user()->createToken('accessToken');

        // Return the token
        return response()->success(
            [
                'user'=> $request->user(),
                'accessToken'=> $token->plainTextToken
            ],
            'Login Successful',
            Response::HTTP_OK
        );
    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->success(
            [
                'message' => 'Logged out'
            ]
        );

    }
}
