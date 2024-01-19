<?php

namespace Tests\Unit;

use App\Models\Despesa;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DespesaTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore()
    {
        $user = Usuario::factory()->create();
        $this->actingAs($user);

        $despesaData = [
            'descricao' => 'Test Expense',
            'data' => '01/01/2022',
            'valor' => 100.25,
        ];

        $despesaModel = new Despesa();
        $despesa = $despesaModel->store($despesaData);

        $this->assertNotNull($despesa->id);
        $this->assertEquals('Test Expense', $despesa->descricao);
        $this->assertInstanceOf(Carbon::class, $despesa->data);
        $this->assertEquals(100.25, $despesa->valor);
        $this->assertEquals($user->id, $despesa->usuario->id);
    }

    public function testValorAttributeConversion()
    {
        $despesa = new Despesa();
        $despesa->valor = 75.50;

        $this->assertEquals(7550 / 100, $despesa->getAttribute('valor'));

        $retrievedValor = $despesa->valor;

        $this->assertEquals(75.50, $retrievedValor);
    }
}
