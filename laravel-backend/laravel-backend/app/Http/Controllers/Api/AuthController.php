<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'hp' => 'required|string|max:30|unique:users,hp',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'nama' => $data['nama'],
            'hp' => $data['hp'],
            'password' => $data['password'], // otomatis di-hash lewat cast 'hashed'
        ]);

        $token = $user->createToken('agenda-kuliah')->plainTextToken;

        return response()->json([
            'user' => ['nama' => $user->nama, 'hp' => $user->hp],
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'hp' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('hp', $data['hp'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'hp' => ['No. HP atau password salah.'],
            ]);
        }

        $token = $user->createToken('agenda-kuliah')->plainTextToken;

        return response()->json([
            'user' => ['nama' => $user->nama, 'hp' => $user->hp],
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Berhasil logout']);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json(['nama' => $user->nama, 'hp' => $user->hp]);
    }
}
