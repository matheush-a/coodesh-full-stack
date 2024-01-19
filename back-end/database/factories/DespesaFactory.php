<?php

namespace Database\Factories;

use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'descricao' => 'Descrição',
            'valor' => 3000,
            'data' => '02/01/2022',
            'usuario_id' => Usuario::factory(),
        ];
    }
}
