<?php

use Faker\Generator as Faker;

//'codrepositorio',
//'codusuario',
//'codprojeto',
//'codmodelodeclarativo',
//'codregra',
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
        'codprojeto' => $modelo->codprojeto ,
        'codrepositorio' => $modelo->codrepositorio ,
        'codusuario' => $modelo->codusuario ,
        'codmodelodeclarativo' => $modelo->codmodelodeclarativo ,
        'codregra' => null,
        'nome' => $faker->word,
        'descricao' => $faker->sentence,
        'tipo' => \App\http\Models\ObjetoFluxo::tipos()[rand(0,5)],
        'visivel_projeto' => 'true',
        'visivel_modelo_declarativo' => 'true',
        'visivel_repositorio' => 'true'
    ];
});
