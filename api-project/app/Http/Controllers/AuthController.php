<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' =>  'required|string|max:100',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

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

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($validated)){
            $user = User::where('email', $validated['email'])->firstOrFail();

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
