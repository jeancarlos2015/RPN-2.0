<?php

use Faker\Generator as Faker;
//'cod_repositorio',
//'codusuario',
//'nome',
//'descricao',
//'visibilidade',
//'publico'
$factory->define(\App\Http\Models\Projeto::class, function (Faker $faker) {
    $usuarios = \App\Http\Repositorys\UserRepository::listar();
    $usuario = $usuarios[rand(0,count($usuarios)-1)];
    $codrepositorio = $usuario->repositorio->cod_repositorio;
    return [
        'cod_repositorio' => $codrepositorio ,
        'codusuario' => $usuario->codusuario ,
        'nome' => $faker->company,
        'descricao' => $faker->sentence,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
