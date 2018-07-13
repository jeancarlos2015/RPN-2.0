<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $primaryKey = 'codtarefa';
    protected $table = 'tarefas';
    protected $fillable = [
        'nome',
        'descricao',
        'codorganizacao',
        'codprojeto',
        'codmodelo',
        'codusuario'
    ];

    public static function titulos()
    {
        return [
            'ID',
            'Nome',
            'Descrição',
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


    public static function atributos()
    {
        return [
            'nome',
            'descricao'
        ];

    }

    public static function validacao(){
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255'
        ];
    }

    public static function dados_objeto(){
        $dado = array();
        for($indice=0;$indice<4;$indice++){
            $dado[$indice] = new Dado();
        }
        return $dado;
    }

    public static function dados(){
        $campos = self::campos();
        $atributos = self::atributos();
        $dados = self::dados_objeto();
        $titulos = self::titulos();
        for ($indice = 0; $indice < 4; $indice++) {
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

    public  function modelo()
    {
        return $this->hasOne(Modelo::class, 'codmodelo', 'codmodelo');
    }

    public  function projeto()
    {
        return $this->hasOne(Projeto::class, 'codprojeto', 'codprojeto');
    }

    public  function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'codorganizacao', 'codorganizacao');
    }
}
