<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'senha' => 'hashed',
    ];

    public function attempt($credentials) {
        $user = $this->newQuery()
            ->whereEmail($credentials['email'])
            ->first();
        
        if(!$user) {
            return null;
        }
        
        $isValid = Hash::check($credentials['senha'], $user->senha);
    
        return $isValid
            ? $user
            : null;
    }

    public function byEmail($email) {
        return $this->newInstance()
            ->whereEmail($email)
            ->first();
    }

    public function Despesa() {
        return $this->hasMany(Despesa::class);
    }

    public function register($data) {
        $instance = $this->newInstance($data);
        $instance->save();

        return $instance;
    }
}
