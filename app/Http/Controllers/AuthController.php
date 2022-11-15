<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:5',
            'confirmPassword' => 'required|same:password'
        ]);

        $user = User::create($request->only('name', 'password', 'email'));

        if (!$user) {
            abort(500, 'Error to create user');
        }

        $res = [
            'accessToken' => $user->createToken('auth_token')->plainTextToken,
            'user' => [
                'userId' => $user->id,
                'userName' => $user->name
            ]
        ];

        return response()->json($res);
    }

    public function login(Request $request)
    {
        // Test User
        // 'email' => 'test@example.com', 'password' => 'password'

        $validateData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email',  $validateData['email'])->first();

        if (!($user && Hash::check($validateData['password'], $user->password))) {
            abort(401, 'Invalid credentials');
        }

        $res = [
            'accessToken' => $user->createToken('auth_token')->plainTextToken,
            'user' => [
                'userId' => $user->id,
                'userName' => $user->name
            ]
        ];

        return response()->json($res);
    }

    public function validToken(Request $request)
    {
        $user = $request->user();

        $res = [
            'accessToken' => $user->createToken('auth_token')->plainTextToken,
            'user' => [
                'userId' => $user->id,
                'userName' => $user->name
            ]
        ];

        return response()->json($res);
    }
}
