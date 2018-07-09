<?php

namespace App\Http\Util;

class Configuracao
{
    public static function create_migrations($database,$connection)
    {

        config(["database.connections.$connection" => [
            "driver" => "sqlite",
//            "host" => "",
//            "port" => "",
            "database" => "../database/".$database,
//            "username" => "",
//            "password" => "",
//            "charset" => "utf8",
//            "collation" => "utf8_unicode_ci",
//            "prefix" => "",
            "strict" => true,
            "engine" => null
        ]]);
        \Artisan::call('migrate', ['--database' => $connection]);
    }


    public static function create_database($nome)
    {
        \File::put('../database/'.$nome,'');
    }



}
