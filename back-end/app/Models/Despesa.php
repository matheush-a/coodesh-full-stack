<?php

namespace App\Models;

use App\Models\Scopes\DespesaScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'data',
        'usuario_id',
        'valor'
    ];

    protected $casts = [
        'data' => 'datetime:Y-m-d',
    ];

    protected static function booted() {
        static::addGlobalScope(new DespesaScope);
    }

    public function store($data) {
        // $data->data = CAST DATA
        $instance = $this->newInstance($data);

        $instance->usuario()
            ->associate(auth()->user());

        $instance->save();

        return $instance;
    }

    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }

    // Salvar valores monetários como ponto flutuante não é uma boa prática
    // por isso o valor será salvo como integer no banco de dados
    // ao registrar uma despesa o valor recebido na requisição será convertido para integer (set)
    // ao buscar uma despesa o valor salvo como integer será convertido para double (get)
    protected function valor(): Attribute {
        return Attribute::make(
            get: fn ($valor) => $valor / 100,
            set: fn ($valor) => $valor * 100,
        );
    }
}
