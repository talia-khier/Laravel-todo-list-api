<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    //
    public function register(RegisterUserRequest $request) {
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
            'token' => $token
        ], 'User logged in successfully', 201);
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return Response::success([
            'user' => $user,
            'token' => $token
        ], 'User logged in successfully');
    }
}
