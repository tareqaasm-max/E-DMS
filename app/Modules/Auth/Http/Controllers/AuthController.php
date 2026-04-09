<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Shared\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return ApiResponse::success(['user' => $user], 'Registered', 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($credentials)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        $token = $request->user()->createToken('edms-api')->plainTextToken;
        return ApiResponse::success(['token' => $token], 'Logged in');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();
        return ApiResponse::success([], 'Logged out');
    }

    public function forgotPassword(): \Illuminate\Http\JsonResponse
    {
        return ApiResponse::success([], 'Password reset link queued');
    }

    public function resetPassword(): \Illuminate\Http\JsonResponse
    {
        return ApiResponse::success([], 'Password updated');
    }
}
