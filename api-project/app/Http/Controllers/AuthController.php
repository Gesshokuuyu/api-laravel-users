<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe()->only(['name', 'email', 'password']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('api-token', ['post.read', 'post.create'])->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe()->only(['email', 'password']);

        if (Auth::attempt($validated)){
            $user = User::where('email', $validated['email'])->firstOrFail();

            $user->tokens()->delete();

            $token = $user->createToken('api-token', ['post.read', 'post.create'])->plainTextToken;

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token
            ]);
        }

        return response()->json([
            'success' => false,
            'user' => null,
            'token' => null
        ], 401);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if(!$token){
            return response()->json([
                'success' => false,
                'msg'     => 'Token não informado'
            ], 400);
        }

        $access_token = PersonalAccessToken::findToken($token);

        if(!$access_token){
            return response()->json([
                'success' => false,
                'msg'     => 'Token fornecido inválido ou já expirado.'
            ], 400);
        }

        $access_token->delete();

        return response()->json([
            'success' => true,
            'msg' => "Logout realizado com sucesso."
        ]);
    }
}
