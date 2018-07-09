<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Regra extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'regras';
    protected $fillable = [
        'operador',
        'tarefa1_id',
        'tarefa2_id',
        'modelo_id',
        'projeto_id',
        'organizacao_id',
        'regra_id',
        'nome'
    ];

    public static function titulos()
    {
        return [
            'ID',
            'Tarefa 1',
            'Operador',
            'Tarefa 2',
            'Ações',
        ];
    }

    public static function campos()
    {
        return [
            'Tarefa 1',
            'Operador',
            'Tarefa 2',
            'Nome da Regra'
        ];
    }

    public static function atributos()
    {
        return [
            'tarefa1_id',
            'operador',
            'tarefa2_id',
            'nome'
        ];

    }

    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 7; $indice++) {
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
            if ($indice < 4) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

    public  function tarefa1()
    {
        return $this->hasOne(Tarefa::class, 'id', 'tarefa1_id');
    }

    public  function tarefa2()
    {
        return $this->hasOne(Tarefa::class, 'id', 'tarefa2_id');
    }
    public  function modelo()
    {
        return $this->hasOne(Modelo::class, 'id', 'modelo_id');
    }

    public  function projeto()
    {
        return $this->hasOne(Projeto::class, 'id', 'projeto_id');
    }

    public  function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'id', 'organizacao_id');
    }
}
