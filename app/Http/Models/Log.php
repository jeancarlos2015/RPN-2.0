<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'codlog';
    protected $table = 'logs';
    protected $fillable = [
        'nome',
        'descricao',
        'codusuario'
    ];
}
