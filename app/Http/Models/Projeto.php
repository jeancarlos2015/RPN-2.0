<?php

namespace App\Http\Models;

use App\Http\Util\Configuracao;
use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Projeto
 *
 * @property int $codprojeto
 * @property string $nome
 * @property string $descricao
 * @property int $codorganizacao
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\Modelo $modelos
 * @property-read \App\Http\Models\Organizacao $organizacao
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCodprojeto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Projeto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Projeto extends Model
{

    protected $primaryKey = 'codprojeto';
    protected $table = 'projetos';
    protected $fillable = [
        'nome',
        'descricao',
        'codorganizacao',
        'codusuario'
    ];


    public static function titulos()
    {
        return [
            'ID',
            'Nome',
            'Descrição',
            'Organização',
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

    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 4; $indice++) {
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
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }


    public function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'codorganizacao', 'codorganizacao');
    }

    public  function modelos()
    {
        return $this->belongsTo(Modelo::class,'codprojeto','codprojeto');
    }



}

