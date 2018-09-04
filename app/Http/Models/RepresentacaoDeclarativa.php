<?php

namespace App\http\Models;

use App\http\Models\ObjetoFluxo;
use App\Http\Models\Projeto;
use App\http\Models\Repositorio;
use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RepresentacaoDeclarativa extends Model
{
//    protected $connection = 'pgsql';
    protected $primaryKey = 'cod_modelo_declarativo';
    protected $table = 'modelos_declarativos';
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',

        'cod_projeto',
        'cod_repositorio',
        'cod_usuario',

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
            'cod_projeto',
            'cod_repositorio',
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
        return $this->hasOne(Projeto::class, 'cod_projeto', 'cod_projeto');
    }

    public function repositorio()
    {
        return $this->hasOne(Repositorio::class, 'cod_repositorio', 'cod_repositorio');
    }
    public function objetos_fluxos()
    {
        return $this->hasMany(ObjetoFluxo::class, 'cod_modelo', 'cod_modelo');
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
