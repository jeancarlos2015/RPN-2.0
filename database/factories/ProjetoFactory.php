<?php

use Faker\Generator as Faker;
//'codrepositorio',
//'codusuario',
//'nome',
//'descricao',
//'visibilidade',
//'publico'
$factory->define(\App\Http\Models\Projeto::class, function (Faker $faker) {
    $codigos_usuarios = \App\Http\Repositorys\UserRepository::listar();
    $usuario = $codigos_usuarios[rand(0,49)];
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
