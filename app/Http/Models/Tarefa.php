<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Tarefa
 *
 * @property int $codtarefa
 * @property string $nome
 * @property string $descricao
 * @property int $codmodelo
 * @property int $codprojeto
 * @property int $codorganizacao
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\Modelo $modelo
 * @property-read \App\Http\Models\Organizacao $organizacao
 * @property-read \App\Http\Models\Projeto $projeto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCodmodelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCodprojeto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCodtarefa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Tarefa whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tarefa extends Model
{
    protected $primaryKey = 'codtarefa';
    protected $table = 'tarefas';
    protected $fillable = [
        'nome',
        'descricao',
        'codorganizacao',
        'codprojeto',
        'codmodelo',
        'codusuario'
    ];

    public static function titulos()
    {
        return [
            'ID',
            'Nome',
            'Descrição',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição'
        ];
    }


    public static function atributos()
    {
        return [
            'nome',
            'descricao'
        ];

    }

    public static function validacao(){
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255'
        ];
    }

    public static function dados_objeto(){
        $dado = array();
        for($indice=0;$indice<4;$indice++){
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

    public static function dados(){
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 4; $indice++) {
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
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
