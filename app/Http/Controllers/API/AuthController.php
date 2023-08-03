<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:3']
        ])->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'data' => [
                'user' => $user,
            ],
            'message' => __('User account created.')
        ]);
    }

    public function login(Request $request)
    {
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required']
        ])->validate();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'data' => [
                    'user' => $user,
                    'token' => $token
                ],
                'mesasge' => __('Successful login')
            ]);
        } else {
            return response()->json([
                'data' => [],
                'mesasge' => __('Invalid username or password')
            ], 422);
        }
    }
}
