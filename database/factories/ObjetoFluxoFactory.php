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
        'codrepositorio' => rand(1,50),
        'codusuario' => rand(1,2),
        'codprojeto' => rand(1,50),
        'codmodelodeclarativo' => rand(1,50),
        'codregra' => null,
        'nome' => $faker->words,
        'descricao' => $faker->sentence,
        'tipo' => rand(0,4),
        'visivel_projeto' => 'true',
        'visivel_modelo_declarativo' => 'true',
        'visivel_repositorio' => 'true'
    ];
});
