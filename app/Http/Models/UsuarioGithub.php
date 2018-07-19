<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioGithub extends Model
{

    protected $primaryKey = 'codusuariogithub';
    protected $table = 'mysql.usuarios_github';
    protected $fillable = [
        'usuario_gihub',
        'codusuario',
        'email_github',
        'token_github',
        'senha_github'
    ];
}
