<?php

use Faker\Generator as Faker;

//'nome',
//'descricao',
//'tipo',
//
//'codprojeto',
//'codrepositorio',
//'codusuario',
//
//'visibilidade',
//'publico',

$factory->define(\App\Http\Models\ModeloDeclarativo::class, function (Faker $faker) {
    return [
        'nome' => $faker->sentence,
        'descricao'=> 'Nenhum',
        'codprojeto' => rand(1,999),
        'codrepositorio' => rand(1,199),
        'codusuario' => rand(1,2),
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
