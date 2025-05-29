<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"Users"},
     *     summary="Register user",
     *     description="Register a new user",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"firstName","lastName","email","password","password_confirmation","dateOfBirth"},
     *
     *             @OA\Property(property="firstName", type="string", example="John"),
     *             @OA\Property(property="lastName", type="string", example="Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="12345768"),
     *             @OA\Property(property="password_confirmation", type="string", example="12345768"),
     *             @OA\Property(property="dateOfBirth", type="string", format="date", example="1998-06-05")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="User registered in successfully"
     *     )
     * )
     */
    public function register(RegisterUserRequest $request)
    {
        $fields = $request->validated();
        $user = User::create([
            'first_name' => $fields['firstName'],
            'last_name' => $fields['lastName'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'date_of_birth' => $fields['dateOfBirth'],
        ]);
        $token = $user->createToken('register_token')->plainTextToken;

        return Response::success([
            'user' => $user,
            'token' => $token,
        ], 'User registered in successfully', 201);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Users"},
     *     summary="Login user",
     *     description="Login user",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="12345768")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="User logged in successfully"
     *     )
     * )
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return Response::success([
            'user' => $user,
            'token' => $token,
        ], 'User logged in successfully');
    }
}
