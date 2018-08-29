<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\Http\Models\RepresentacaoDiagramatico;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Models\Repositorio;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Projeto
 *
 * @property int $codprojeto
 * @property string $nome
 * @property string $descricao
 * @property int $codrepositorio
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\RepresentacaoDiagramatico $modelos
 * @property-read \App\Http\Models\Repositorio $repositorio
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
    protected $connection = "banco";
    protected $primaryKey = 'cod_projeto';
    protected $table = 'projetos';
    protected $fillable = [
        'cod_repositorio',
        'cod_usuario',
        'nome',
        'descricao',
        'visibilidade',
        'publico'
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
//            'ID',
//            'Nome',
//            'Descrição',
//            'Organização',
            'Projetos',
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

    public static function atributos_dos_campos()
    {
        return [
            'nome',
            'descricao'
        ];

    }
    public static function types()
    {
        return [
            'text',
            'text'
        ];
    }
    //Instancia todas as posições de memória que serão exibidas no título
    public static function dados_exibidos_no_titulo()
    {
        $dado = array();
        for ($indice = 0; $indice < 2; $indice++) {
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
        for ($indice = 0; $indice < 2; $indice++) {
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
                $dados[$indice]->tipo = $types[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'cod_usuario', 'cod_usuario');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'cod_repositorio', 'cod_repositorio');
    }

    public function modelos_diagramaticos()
    {
        return $this->hasMany(RepresentacaoDiagramatico::class, 'cod_projeto', 'cod_projeto');
    }

    public function modelos_declarativos()
    {
        return $this->hasMany(RepresentacaoDeclarativa::class, 'cod_projeto', 'cod_projeto');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($modelo) { // before delete() method call this
            $modelo->modelos_diagramaticos()->delete();
        });

    }


}

