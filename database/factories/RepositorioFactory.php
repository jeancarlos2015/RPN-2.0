<?php

use Faker\Generator as Faker;
//'nome',
//'descricao',
//'visibilidade',
//'publico'

$factory->define(\App\http\Models\Repositorio::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'descricao' => $faker->sentence,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
