<?php

namespace App\Http\Models;

use App\Http\Util\Dado;
use Illuminate\Database\Eloquent\Model;

class UsuarioGithub extends Model
{

    protected $primaryKey = 'codusuariogithub';
    protected $table = 'usuarios_github';
    protected $fillable = [
        'usuario_github',
        'codusuario',
        'email_github',
        'token_github',
        'branch_atual',
        'repositorio_atual',
        'senha_github'
    ];

    public static function validacao()
    {
        return [
            'usuario_github' => 'required|max:50',
            'email_github' => 'required|max:50',
            'token_github' => 'required|max:50',
            'senha_github' => 'required|max:50',
        ];
    }

    public static function titulos()
    {
        return [
            'ID',
            'Usuário Do Github',
            'Usuário Do Sistema',
            'Email Do Github',
            'Token Do Github',
            'Senha Do Github',
            'Ações'
        ];
    }

    public static function campos()
    {
        return [
            'Usuário Do Github',
            'Email Do Github',
            'Token Do Github',
            'Senha Do Github'
        ];
    }

    public static function atributos()
    {
        return [
            'usuario_github',
            'email_github',
            'token_github',
            'senha_github'
        ];

    }

//Instancia todas as posições de memória que serão exibidas no título
    public static function dados_objeto()
    {
        $dado = array();
        for ($indice = 0; $indice < 7; $indice++) {
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

        for ($indice = 0; $indice < 7; $indice++) {
            if ($indice < 4) {
                $dados[$indice]->campo = $campos[$indice];
                $dados[$indice]->atributo = $atributos[$indice];
            }
            $dados[$indice]->titulo = $titulos[$indice];

        }
        return $dados;
    }
}
