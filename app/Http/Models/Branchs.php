<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Branchs extends Model
{
    protected $primaryKey = 'codbranch';
    protected $fillable = [
        'branch',
        'descricao',
        'codusuario'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }
}
