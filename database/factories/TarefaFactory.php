<?php

use Faker\Generator as Faker;

$factory->define(App\Tarefa::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->paragraph
    ];
});
