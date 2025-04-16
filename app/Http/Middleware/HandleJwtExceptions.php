<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class HandleJwtExceptions
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o cabeçalho Authorization existe
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['error' => 'Token não encontrado'], 401);
        }

        try {
            // Tenta autenticar o token
            $user = JWTAuth::parseToken()->authenticate();

            // Se o token for válido, continua o fluxo da requisição
            $request->auth = $user; // Atribuindo o usuário autenticado à requisição

            return $next($request);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expirado'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token malformado ou não encontrado'], 401);
        }
    }
}
