<?php

use Faker\Generator as Faker;

$factory->define(App\Projeto::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->paragraph
    ];
});
