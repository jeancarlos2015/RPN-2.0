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
    return [
        'codrepositorio' => rand(1,199),
        'codusuario' => rand(1,2),
        'codprojeto' => rand(1,999),
        'codmodelodeclarativo' => rand(1,4999),
        'codregra' => null,
        'nome' => $faker->word,
        'descricao' => $faker->sentence,
        'tipo' => \App\http\Models\ObjetoFluxo::tipos()[rand(0,5)],
        'visivel_projeto' => 'true',
        'visivel_modelo_declarativo' => 'true',
        'visivel_repositorio' => 'true'
    ];
});
