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
        'codprojeto' => 1,
        'codrepositorio' => 1,
        'codusuario' => 1,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
