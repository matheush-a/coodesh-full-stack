<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected Usuario $usuario;
    protected Validator $validator;

    function __construct(Usuario $usuario, Validator $validator){
        $this->usuario = $usuario;
        $this->validator = $validator;
    }

    public function login(Request $request) {
        $this->validator->validate($request, [
            'email' => ['required'],
            'senha' => ['required'],
        ]);
        
        $attempt = $this->usuario
            ->attempt($request
            ->only('email', 'senha'));

        if(!$attempt) {
            return response()->json(
                ["message" => "Unauthenticated"],
                 Response::HTTP_UNAUTHORIZED
            );
        }

        $token = $attempt->createToken(md5(microtime()));

        return response()->json(
            $token->plainTextToken,
            Response::HTTP_OK
        );
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            "Token successfully deleted",
            Response::HTTP_NO_CONTENT
        );
    }
}
