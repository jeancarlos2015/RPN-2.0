<?php

namespace App\Http\Models;

use App\Http\Util\Configuracao;
use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'projetos';
    protected $fillable = [
        'nome',
        'descricao',
        'organizacao_id',
        'user_id'
    ];


    public static function titulos()
    {
        return [
            'ID',
            'Nome',
            'Descrição',
            'Organização',
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

    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 4; $indice++) {
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
            if ($indice < 2) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }


    public function organizacao()
    {
        return $this->hasOne(Organizacao::class, 'id', 'organizacao_id');
    }

    public  function modelos()
    {
        return $this->belongsTo(Modelo::class,'id','modelo_id');
    }



}

