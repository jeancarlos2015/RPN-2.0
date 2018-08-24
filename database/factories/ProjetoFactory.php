<?php

use Faker\Generator as Faker;
//'codrepositorio',
//'codusuario',
//'nome',
//'descricao',
//'visibilidade',
//'publico'
$factory->define(\App\Http\Models\Projeto::class, function (Faker $faker) {
    return [
        'codrepositorio' => rand(1,50),
        'codusuario' => rand(1,2),
        'nome' => $faker->company,
        'descricao' => $faker->sentence,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
