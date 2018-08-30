<?php

use Faker\Generator as Faker;

//'cod_repositorio',
//'codusuario',
//'cod_projeto',
//'cod_modelo_declarativo',
//'cod_outra_regra',
//'nome',
//'tipo',
//'visivel_projeto',
//'visivel_repositorio',
//'visivel_modelo_declarativo',
//'relacionamento'


$factory->define(\App\http\Models\Regra::class, function (Faker $faker) {
    return [
        'cod_repositorio' => rand(1,49),
        'codusuario' => rand(1,49),
        'cod_projeto' => rand(1,49),
        'cod_modelo_declarativo' => rand(1,49),
        'cod_outra_regra' => null,
        'nome' => $faker->word,
        'tipo' => 'regra',
        'visivel_projeto' => 'true',
        'visivel_repositorio' => 'true',
        'visivel_modelo_declarativo' => 'true',
        'relacionamento' => rand(0,4)
    ];
});
