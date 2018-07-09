<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'modelos';
    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'xml_modelo',
        'projeto_id',
        'organizacao_id'
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
            'projeto_id',
            'organizacao_id',
            'xml_modelo'

        ];

    }
//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto(){
        $dado = array();
        for($indice=0;$indice<7;$indice++){
            $dado[$indice] = new Dado();
        }
        return $dado;
    }
//Instancia somente os campos que serão exibidos no formulário
    public static function dados(){
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 7; $indice++) {
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
        return $this->hasOne(Projeto::class, 'id', 'projeto_id');
    }

    public  function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'id', 'organizacao_id');
    }

    public  function regras()
    {
        return $this->belongsTo(Regra::class,'modelo_id','id');
    }

    public function tarefas(){
        return $this->belongsTo(Tarefa::class,'modelo_id','id');
    }

}
