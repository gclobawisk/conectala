<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validação das credenciais
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Recupera as credenciais
        $credentials = $request->only('email', 'password');

        // Tenta gerar o token
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Retorna o token
        return response()->json(compact('token'));
    }

    public function me()
    {
        // Retorna os dados do usuário autenticado
        return response()->json(auth()->user());
    }

    public function logout()
    {
        // Invalidando o token
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
