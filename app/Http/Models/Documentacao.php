<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Documentacao extends Model
{
    protected $connection = 'pgsql';
    protected $primaryKey = 'coddocumentacao';
    protected $table = 'documentacoes';
    protected $fillable = [
        'nome',
        'descricao',
        'link',
        'visibilidade',
        'codusuario'
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
//            'Código',
//            'Nome',
//            'Descrição',
            'Usuário',
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
        for ($indice = 0; $indice < 5; $indice++) {
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
        for ($indice = 0; $indice < 3; $indice++) {
            if ($indice < 2) {

                $dados[$indice]->titulo = $titulos[$indice];
            }
            $dados[$indice]->campo = $campos[$indice];
            $dados[$indice]->atributo = $atributos[$indice];

        }
        return $dados;
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'codusuario', 'codusuario');
    }
}
