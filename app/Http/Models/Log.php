<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Log
 *
 * @property int $codlog
 * @property string $nome
 * @property string $descricao
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCodlog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Log extends Model
{

    protected $primaryKey = 'codlog';
    protected $table = 'logs';
    protected $fillable = [
        'nome',
        'descricao',
        'codusuario',
        'ocorrencia'
    ];


    public  function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }
}
