<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsuarioController extends Controller
{
    protected Usuario $usuario;
    protected Validator $validator;

    public function __construct(Usuario $usuario, Validator $validator) {
        $this->usuario = $usuario;
        $this->validator = $validator;
    }

    public function index() {
        return $this->usuario->all();
    }

    public function store(Request $request) {
        $this->validator->validate($request, [
            'email' => ['required', 'email', 'unique:usuarios'],
            'nome' => ['required', 'min:3'],
            'senha' => ['required', 'min:8'],
        ]);
    
        $usuario = $this->usuario->register($request->all());
        
        return $usuario;
    }

    public function update(Request $request) {
        $this->validator->validate($request, [
            'email' => ['email', 'unique:usuarios'],
            'nome' => ['min:3'],
            'senha' => ['min:8'],
        ]);

        $usuario = $this->usuario->find($request->user()->id);

        if(!$usuario) {
            return response()->json("Usuário not found", Response::HTTP_NOT_FOUND);
        }

        return $this->usuario->updateUser($usuario->id, $request->all());
    }
}
