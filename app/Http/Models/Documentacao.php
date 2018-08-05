<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

class Documentacao extends Model
{
    protected $primaryKey = 'coddocumentacao';
    protected $table = 'documentacoes';
    protected $fillable = [
        'nome',
        'descricao',
        'link',
        'visibilidade'
    ];

    public static function validacao()
    {
        return [
            'nome' => 'required|max:50',
            'descricao' => 'required|max:255',
            'link' => 'required|max:255'
        ];
    }

    public static function titulos()
    {
        return [
            'Código',
            'Nome',
            'Descrição',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Nome',
            'Descrição',
            'Link'
        ];
    }

    public static function atributos()
    {
        return [

            'nome',
            'descricao',
            'link'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 4; $indice++) {
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
        for ($indice = 0; $indice < 4; $indice++) {
            if ($indice < 3) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }

}
