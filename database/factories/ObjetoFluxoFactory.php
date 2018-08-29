<?php

use Faker\Generator as Faker;

//'cod_repositorio',
//'codusuario',
//'cod_projeto',
//'cod_modelo_declarativo',
//'cod_regra',
//'nome',
//'descricao',
//'tipo',
//'visivel_projeto',
//'visivel_modelo_declarativo',
//'visivel_repositorio'


$factory->define(\App\http\Models\ObjetoFluxo::class, function (Faker $faker) {
    $modelos = \App\Http\Repositorys\ModeloDeclarativoRepository::listar_modelos();
    $modelo = $modelos[rand(0,count($modelos)-1)];
    return [
        'cod_projeto' => $modelo->cod_projeto ,
        'cod_repositorio' => $modelo->cod_repositorio ,
        'codusuario' => $modelo->codusuario ,
        'cod_modelo_declarativo' => $modelo->cod_modelo_declarativo ,
        'cod_regra' => null,
        'nome' => $faker->word,
        'descricao' => $faker->sentence,
        'tipo' => \App\http\Models\ObjetoFluxo::tipos()[rand(0,5)],
        'visivel_projeto' => 'true',
        'visivel_modelo_declarativo' => 'true',
        'visivel_repositorio' => 'true'
    ];
});
