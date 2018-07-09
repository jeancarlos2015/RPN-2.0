<?php

namespace App\Http\Repositories;

class ArquivoRepository
{
    public static function cria_arquivo_regras($tabela)
    {
        file_put_contents('regras.txt', $tabela);
    }


    public static function cria_arquivo_recursos($data)
    {
    }



}
