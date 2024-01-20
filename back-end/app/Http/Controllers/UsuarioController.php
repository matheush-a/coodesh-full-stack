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

    public function destroy($id) {
        $usuario = $this->usuario->find($id);

        if(!$usuario) {
            return response()->json("Usuário not found", Response::HTTP_NOT_FOUND);
        }
        
        $usuario->delete();

        return response()->json("Usuário sucessfully deleted", Response::HTTP_NO_CONTENT);
    }

    public function index() {
        return $this->usuario->all();
    }

    public function show($id) {
        return $this->usuario->find($id);
    }

    public function store(Request $request) {
        $this->validator->validate($request, [
            'email' => ['required', 'email', 'unique:usuarios'],
            'nome' => ['required'],
            'senha' => ['required'],
        ]);
    
        $usuario = $this->usuario->register($request->all());
        
        return $usuario;
    }

    public function update($id, Request $request) {
        $this->validator->validate($request, [
            'email' => ['email', 'unique:usuarios,id'],
        ]);

        $usuarioPorEmail = $this->usuario->byEmail($request['email']);
        $usuario = $this->usuario->find($id);

        if($usuarioPorEmail['id'] !== $usuario['id']) {
            return response()->json("This email already exists in our database.", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(!$usuario) {
            return response()->json("Usuário not found", Response::HTTP_NOT_FOUND);
        }

        return $this->usuario->updateUser($usuario->id, $request->all());
    }
}
