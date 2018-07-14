<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Organizacao
 *
 * @property int $codorganizacao
 * @property string $nome
 * @property string $descricao
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\Projeto $projetos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Organizacao whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Organizacao whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Organizacao whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Organizacao whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Organizacao whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Organizacao whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Organizacao extends Model
{
    protected $primaryKey = 'codorganizacao';
    protected $table = 'organizacoes';
    protected $fillable = [
        'nome',
        'descricao',
        'codusuario'
    ];

    public static function regras_validacao()
    {
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255'
        ];
    }

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

    public function projetos()
    {
        return $this->belongsTo(Projeto::class, 'codorganizacao', 'codorganizacao');
    }
}
