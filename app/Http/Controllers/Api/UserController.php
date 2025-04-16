<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) return response()->json(['error' => 'Usuário não encontrado'], 404);

        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required'     => 'O nome é obrigatório.',
            'name.string'       => 'O nome deve ser uma sequência de caracteres.',
            'name.max'          => 'O nome não pode ter mais de :max caracteres.',
            'name.regex' => 'O nome deve conter apenas letras, espaços ou hífens.',

            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'email.unique'      => 'Este e-mail já está em uso.',
    
            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve ter no mínimo :min caracteres.',
            'password.string'   => 'A senha deve ser uma sequência de caracteres.',
            'password.regex' => 'A senha deve conter letras, números e pelo menos um caractere especial.',

        ];
        
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ],

        ], $messages);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'user' => $user,
        ], 201);
    }

    public function update(Request $request, User $user)
    {
        $messages = [
            'name.required'     => 'O nome é obrigatório.',
            'name.string'       => 'O nome deve ser uma sequência de caracteres.',
            'name.max'          => 'O nome não pode ter mais de :max caracteres.',
            'name.regex'        => 'O nome deve conter apenas letras, espaços ou hífens.',

            'email.required'    => 'O e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'email.unique'      => 'Este e-mail já está em uso.',

            'password.min'      => 'A senha deve ter no mínimo :min caracteres.',
            'password.string'   => 'A senha deve ser uma sequência de caracteres.',
            'password.regex'    => 'A senha deve conter letras, números e pelo menos um caractere especial.',
        ];

        $rules = [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ];

        // Só adiciona as regras de senha se o campo vier preenchido
        if ($request->filled('password')) {
            $rules['password'] = [
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).+$/',
            ];
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso',
            'user' => $user,
        ]);
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['error' => 'Usuário não encontrado'], 404);

        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
    }
}
