<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\User;
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
    protected $connection = 'banco';
    protected $primaryKey = 'codorganizacao';
    protected $table = 'organizacoes';
    protected $fillable = [
        'nome',
        'descricao',
        'codusuario',
        'visibilidade'
    ];

    public static function validacao()
    {
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255'
        ];
    }

    public static function titulos_da_tabela()
    {
        return [
            'ID',
            'Nome',
            'Descrição',
            'Responsavel',
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

    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }
    public static function atributos_dos_campos()
    {
        return [

            'nome',
            'descricao'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_exibidos_no_titulo()
    {
        $dado = array();
        for ($indice = 0; $indice < 5; $indice++) {
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem

    public static function dados()
    {
        $campos = self::campos();
        $atributos = self::atributos_dos_campos();
        $dados = self::dados_exibidos_no_titulo();
        $types = self::types();
        $titulos = self::titulos_da_tabela();
        for ($indice = 0; $indice < 5; $indice++) {
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
                $dados[$indice]->type = $types[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }
    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }

    public function projetos()
    {
        return $this->belongsTo(Projeto::class, 'codorganizacao', 'codorganizacao');
    }

    public function modelos()
    {
        return $this->belongsTo(Modelo::class, 'codorganizacao', 'codorganizacao');
    }

    public function regras()
    {
        return $this->belongsTo(Regra::class, 'codorganizacao', 'codorganizacao');
    }

    public function tarefas()
    {
        return $this->belongsTo(Tarefa::class, 'codorganizacao', 'codorganizacao');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($projeto) { // before delete() method call this
            $projeto->projetos()->delete();
        });

        static::deleting(function ($modelo) { // before delete() method call this
            $modelo->modelos()->delete();
        });

        static::deleting(function ($tarefa) { // before delete() method call this
            $tarefa->tarefas()->delete();
        });

        static::deleting(function ($regra) { // before delete() method call this
            $regra->regras()->delete();
        });
    }
}
