<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Facedas\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Buat user baru setelah validasi berhasil
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // Buat token untuk user yang baru terdaftar
        $token = $user->createToken('API Token')->plainTextToken;

        // Kembalikan respons dengan data user dan token
        return response()->json([
            'error' => false,
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ], 201);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return response()->json([
                'error' => true,
                'message' => 'Unauthorized User',
                'data' => []
            ], 401);
        }

        $user = Auth::user();
        $token = $user->crateToken('Api Token')->plainTextToken;

        return response()->json([
            'error' => false,
            'message' => 'Login Successfully!',
            'data' => [
                'token' => $token
                ]
            ], 200);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'error' => false,
            'message' => 'Logout Successfully'
        ], 200);
    }
}
