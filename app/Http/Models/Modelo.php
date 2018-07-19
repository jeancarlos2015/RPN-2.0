<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Modelo
 *
 * @property int $codmodelo
 * @property string $nome
 * @property string $descricao
 * @property string $tipo
 * @property string $xml_modelo
 * @property int $codprojeto
 * @property int $codorganizacao
 * @property int $codusuario
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Http\Models\Organizacao $organizacao
 * @property-read \App\Http\Models\Projeto $projeto
 * @property-read \App\Http\Models\Regra $regras
 * @property-read \App\Http\Models\Tarefa $tarefas
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereCodmodelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereCodorganizacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereCodprojeto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereCodusuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Modelo whereXmlModelo($value)
 * @mixin \Eloquent
 */
class Modelo extends Model
{
    protected $connection = 'banco';
    protected $primaryKey = 'codmodelo';
    protected $table = 'modelos';
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'xml_modelo',
        'codprojeto',
        'codorganizacao',
        'codusuario'
    ];


    public static function titulos()
    {
        return [
            'ID',
            'Nome',
            'Descrição',
            'Tipo',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição',
            'Tipo'
        ];
    }

    public static function atributos()
    {
        return [
            'nome',
            'descricao',
            'tipo',
            'codprojeto',
            'codorganizacao',
            'xml_modelo'

        ];

    }
//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto(){
        $dado = array();
        for($indice=0;$indice<5;$indice++){
            $dado[$indice] = new Dado();
        }
        return $dado;
    }
//Instancia somente os campos que serão exibidos no formulário e preenche os títulos da listagem
    public static function dados(){
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 5; $indice++) {
            if ($indice < 3) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

//Relacionamentos
    public  function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public  function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'codorganizacao', 'codorganizacao');
    }

    public function regras()
    {
        return $this->belongsTo(Regra::class, 'codmodelo', 'codmodelo');
    }

    public static function validacao(){
        return [
            'nome' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
        ];
    }
    public function tarefas()
    {
        return $this->belongsTo(Tarefa::class, 'codmodelo', 'codmodelo');
    }

    protected static function boot() {
        parent::boot();


        static::deleting(function($tarefa) { // before delete() method call this
            $tarefa->tarefas()->delete();
        });

        static::deleting(function($regra) { // before delete() method call this
            $regra->regras()->delete();
        });
    }
}
