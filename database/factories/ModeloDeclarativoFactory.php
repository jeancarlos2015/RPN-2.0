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
        'codprojeto' => rand(1,49),
        'codrepositorio' => rand(1,49),
        'codusuario' => rand(1,49),
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
