<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'logs';
    protected $fillable = [
        'nome',
        'descricao',
        'user_id'
    ];
}
