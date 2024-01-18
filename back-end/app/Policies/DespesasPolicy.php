<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\User;
use App\Models\Usuario;

class DespesaPolicy
{
    protected Usuario $usuario;
    protected Despesa $despesa;

    public function __construct(Usuario $usuario, Despesa $despesa) {
        $this->usuario = $usuario;
        $this->despesa = $despesa;
    }

    public function interact() {
        return $this->despesa->usuario_id === $this->usuario->id;
    }
}
