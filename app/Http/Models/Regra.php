<?php

namespace App\http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Projeto;
use App\Http\Models\Repositorio;
use App\Http\Models\ObjetoFluxo;
use App\Http\Models\RepresentacaoDeclarativa;

class Regra extends Model
{
    const PADROES = [
        'INDEPENDENCIA',
        'DEPENDENCIA ESTRITA',
        'DEPENDENCIA CIRCUNSTANCIAL' ,
        'NAO COEXISTENCIA',
        'UNIAO'
    ];
    protected $connection = 'banco';
    protected $primaryKey = 'cod_regra';
    protected $table = 'regras';
    protected $fillable = [
        'cod_repositorio',
        'cod_usuario',
        'cod_projeto',
        'cod_modelo_declarativo',
        'cod_outra_regra',
        'nome',
        'tipo',
        'visivel_projeto',
        'visivel_repositorio',
        'visivel_modelo_declarativo',
        'relacionamento'
    ];



    public static function titulos()
    {
        return [
            'Regras',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
        ];
    }

    public static function types()
    {
        return [
            'text'
        ];
    }

    public static function atributos()
    {
        return [
            'nome'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
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
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        $types = self::types();
        //quantidade de atributos
        for ($indice = 0; $indice < 2; $indice++) {
            //quantidade do restante dos campos
            if ($indice < 1) {
                $dados[$indice]->atributo = $atributos[$indice];
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->tipo = $types[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];
        }
        return $dados;
    }

//Relacionamentos
    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'cod_projeto', 'cod_projeto');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'cod_repositorio', 'cod_repositorio');
    }


    public function objetos_fluxos()
    {
        return $this->hasMany(ObjetoFluxo::class, 'cod_regra', 'cod_regra');
    }

    public function modelodeclarativo(){
        return $this->hasOne(RepresentacaoDeclarativa::class, 'cod_modelo_declarativo', 'cod_modelo_declarativo');
    }

    public static function validacao()
    {
        return [
            'nome' => 'required',
            'descricao' => 'required'
        ];
    }


    protected static function boot()
    {
        parent::boot();


    }


    public function usuario()
    {
        return $this->hasOne(User::class, 'cod_usuario', 'cod_usuario');
    }
}
