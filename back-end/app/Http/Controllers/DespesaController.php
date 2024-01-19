<?php

namespace App\Http\Controllers;

use App\Lib\Validator;
use App\Mail\DespesaCreated;
use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class DespesaController extends Controller
{
    protected Despesa $despesa;
    protected Validator $validator;

    public function __construct(Despesa $despesa, Validator $validator) {
        $this->despesa = $despesa;
        $this->validator = $validator;
    }

    public function delete($id) {
        $despesa = $this->despesa->find($id);

        if(!$despesa) {
            return response()->json("Despesa not found", Response::HTTP_NOT_FOUND);
        }

        $this->authorize('interact', $despesa);
        $despesa->delete();

        return response()->json("Despesa sucessfully deleted", Response::HTTP_NO_CONTENT);
    }

    public function index() {
        $despesa = $this->despesa->all();
        return $despesa->load('usuario');
    }

    public function store(Request $request) {
        $this->validator->validate($request, [
            'descricao' => ['required', 'max:191'],
            'valor' => ['required', 'numeric', 'min:0'],
            'data' => ['required', 'date_format:d/m/Y', 'before_or_equal:' . now()->format('d/m/Y')],
        ]);
    
        $despesa = $this->despesa->store($request->all());

        $despesa->load('usuario');

        Mail::to($despesa->usuario->email)
            ->send(new DespesaCreated($despesa->usuario));
        
        return $despesa;
    }

    public function update(Request $request) {
        $this->validator->validate($request, [
            'id' => ['required', 'numeric', 'exists:despesas'],
            'descricao' => ['max:191'],
            'valor' => ['numeric', 'min:0'],
            'data' => ['date_format:d/m/Y', 'before_or_equal:' . now()->format('d/m/Y')],
        ]);
    
        $despesa = $this->despesa->updateDespesa($request->all());

        if(!$despesa) {
            return response()->json("Despesa not found", Response::HTTP_NOT_FOUND);
        }

        $despesa->load('usuario');
        
        return $despesa;
    }
}
