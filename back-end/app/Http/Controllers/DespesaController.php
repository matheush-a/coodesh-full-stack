<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Models\Despesa;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    protected Despesa $despesa;
    protected Validator $validator;

    public function __construct(Despesa $despesa, Validator $validator) {
        $this->despesa = $despesa;
        $this->validator = $validator;
    }

    public function index() {
        return $this->despesa->all();
    }

    public function store(Request $request) {
        $this->validator->validate($request, [
            'descricao' => ['required', 'max:191'],
            'valor' => ['required', 'numeric', 'min:0'],
            'data' => ['required', 'date'],
        ]);
    
        $despesa = $this->despesa->store($request->all());
        
        return $despesa;
    }
}
