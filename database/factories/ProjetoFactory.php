<?php

use Faker\Generator as Faker;
//'codrepositorio',
//'codusuario',
//'nome',
//'descricao',
//'visibilidade',
//'publico'
$factory->define(\App\Http\Models\Projeto::class, function (Faker $faker) {
    $usuarios = \App\Http\Repositorys\UserRepository::listar();
    $usuario = $usuarios[rand(0,count($usuarios)-1)];
    $codrepositorio = $usuario->repositorio->codrepositorio;
    return [
        'codrepositorio' => $codrepositorio ,
        'codusuario' => $usuario->codusuario ,
        'nome' => $faker->company,
        'descricao' => $faker->sentence,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
