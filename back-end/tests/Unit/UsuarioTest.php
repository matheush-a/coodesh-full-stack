<?php

namespace Tests\Unit;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use DatabaseTransactions;

    public function testAttemptWithValidCredentials()
    {
        $password = 'testpassword';
        $user = Usuario::factory()->create([
            'senha' => Hash::make($password),
        ]);

        $credentials = [
            'email' => $user->email,
            'senha' => $password,
        ];

        $usuarioModel = new Usuario();
        $result = $usuarioModel->attempt($credentials);

        $this->assertInstanceOf(Usuario::class, $result);
        $this->assertEquals($user->id, $result->id);
    }

    public function testAttemptWithInvalidCredentials()
    {
        $credentials = [
            'email' => 'nonexistent@example.com',
            'senha' => 'invalidpassword',
        ];

        $usuarioModel = new Usuario();
        $result = $usuarioModel->attempt($credentials);

        $this->assertNull($result);
    }

    public function testByEmail()
    {
        $user = Usuario::factory()->create(['email' => 'testuser@example.com']);

        $usuarioModel = new Usuario();
        $result = $usuarioModel->byEmail('testuser@example.com');

        $this->assertInstanceOf(Usuario::class, $result);
        $this->assertEquals($user->id, $result->id);
    }

    public function testRegister()
    {
        $userData = [
            'nome' => 'Test User',
            'email' => 'testuser@example.com',
            'senha' => 'testpassword',
        ];

        $usuarioModel = new Usuario();
        $result = $usuarioModel->register($userData);

        $this->assertInstanceOf(Usuario::class, $result);
        $this->assertEquals('Test User', $result->nome);
        $this->assertEquals('testuser@example.com', $result->email);
        $this->assertTrue(Hash::check('testpassword', $result->senha));
    }
}

