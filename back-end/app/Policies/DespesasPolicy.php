<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class DespesasPolicy
{
    use HandlesAuthorization;

    public function interact(Usuario $usuario, Despesa $despesa) {
        return $despesa->usuario_id === $usuario->id;
    }
}
