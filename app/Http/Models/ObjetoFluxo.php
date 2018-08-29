<?php

namespace App\http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Repositorio;
use App\Http\Models\RepresentacaoDeclarativa;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;

class ObjetoFluxo extends Model
{

    protected $connection = "banco";
    protected $primaryKey = 'cod_objeto_fluxo';
    protected $table = 'objetos_fluxos';
    protected $fillable = [

        'cod_repositorio',
        'cod_usuario',
        'cod_projeto',
        'cod_modelo_declarativo',
        'cod_regra',
        'nome',
        'descricao',
        'tipo',
        'visivel_projeto',
        'visivel_modelo_declarativo',
        'visivel_repositorio'
    ];

    public static function tipos()
    {
        return [
            'TAREFA',
            'GATEWAY EXCLUSIVO',
            'EVENTO DE ÍNICIO',
            'EVENTO DE FIM',
            'GATEWAY PARALELO',
            'EVENTO INTERMEDIÁRIO'
        ];
    }

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
            'Objetos De Fluxo',
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

    public function projeto()
    {
        return $this->hasOne(Projeto::class, 'cod_projeto', 'cod_projeto');
    }

    public function modelo()
    {
        return $this->hasOne(RepresentacaoDeclarativa::class, 'cod_modelo_declarativo', 'cod_modelo_declarativo');
    }

    public function regra()
    {
        return $this->hasOne(Regra::class, 'cod_regra', 'cod_regra');
    }

    protected static function boot()
    {
        parent::boot();


        static::deleting(function ($regra) { // before delete() method call this
            $regra->regras()->delete();
        });
    }

}
