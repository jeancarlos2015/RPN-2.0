<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
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

    public  function regras()
    {
        return $this->belongsTo(Regra::class,'codmodelo','codmodelo');
    }

    public function tarefas(){
        return $this->belongsTo(Tarefa::class,'codmodelo','codmodelo');
    }

}
