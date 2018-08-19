<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\User;
use App\Http\Models\Projeto;
use App\Http\Models\Repositorio;
use App\Http\Models\ObjetoFluxo;

use Illuminate\Database\Eloquent\Model;

class ModeloDeclarativo extends Model
{
    protected $connection = 'banco';
    protected $primaryKey = 'codmodelodeclarativo';
    protected $table = 'modelo_declarativos';
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',

        'codprojeto',
        'codrepositorio',
        'codusuario',

        'visibilidade',
        'publico',

    ];


    public static function titulos()
    {
        return [
            'Modelos',
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

    public static function atributos()
    {
        return [
            'nome',
            'descricao',
            'tipo',
            'codprojeto',
            'codrepositorio',
            'xml_modelo'

        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 3; $indice++) {
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
        for ($indice = 0; $indice < 3; $indice++) {
            //quantidade do restante dos campos
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->tipo = $types[$indice];
                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->atributo = $atributos[$indice];


        }
        return $dados;
    }

//Relacionamentos
    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'codrepositorio', 'codrepositorio');
    }
    public function objetos_fluxos()
    {
        return $this->hasMany(ObjetoFluxo::class, 'codmodelodeclarativo', 'codmodelodeclarativo');
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
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }
}
