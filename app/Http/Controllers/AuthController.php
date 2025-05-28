<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;


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
        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
