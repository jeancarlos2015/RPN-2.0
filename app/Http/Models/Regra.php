<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Regra
 *
 * @property int $codregra
 * @property string $operador
 * @property string $nome
 * @property int $codtarefa1
 * @property int $codtarefa2
 * @property int $codprojeto
 * @property int $codorganizacao
 * @property int $codmodelo
 * @property int $codregra1
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\Modelo $modelo
 * @property-read \App\Http\Models\Organizacao $organizacao
 * @property-read \App\Http\Models\Projeto $projeto
 * @property-read \App\Http\Models\Tarefa $tarefa1
 * @property-read \App\Http\Models\Tarefa $tarefa2
 * @property-read \App\Http\Models\Tarefa $tarefas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodmodelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodprojeto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodregra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodregra1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodtarefa1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodtarefa2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereOperador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Regra whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Regra extends Model
{
    protected $primaryKey = 'codregra';
    protected $table = 'regras';
    protected $fillable = [
        'operador',
        'nome',
        'codtarefa1',
        'codtarefa2',
        'codregra1',

        'codmodelo',
        'codprojeto',
        'codorganizacao',
        'codusuario'
    ];

    public static function titulos()
    {
        return [
            'ID',
            'Tarefa 1',
            'Operador',
            'Tarefa 2',
            'Ações',
        ];
    }

    public static function campos()
    {
        return [
            'Tarefa 1',
            'Operador',
            'Tarefa 2',
            'Nome da Regra'
        ];
    }

    public static function atributos()
    {
        return [
            'codtarefa1',
            'operador',
            'codtarefa2',
            'nome'
        ];

    }

    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 7; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 4; $indice++) {
            if ($indice < 4) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }


    public  function tarefa1()
    {
        return $this->belongsTo(Tarefa::class, 'codtarefa1', 'codtarefa');
    }
    public  function tarefa2()
    {
        return $this->belongsTo(Tarefa::class, 'codtarefa2', 'codtarefa');
    }



    public  function modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
    }

    public  function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public  function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'codorganizacao', 'codorganizacao');
    }
}