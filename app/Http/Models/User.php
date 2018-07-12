<?php

namespace App;

use App\Http\Models\Organizacao;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'codusuario';
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function organizacoes(){
        return $this->belongsTo(Organizacao::class,'codusuario','codusuario');
    }
}
