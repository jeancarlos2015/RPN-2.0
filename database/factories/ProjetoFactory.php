<?php

use Faker\Generator as Faker;
//'codrepositorio',
//'codusuario',
//'nome',
//'descricao',
//'visibilidade',
//'publico'
$factory->define(\App\Http\Models\Projeto::class, function (Faker $faker) {
    $codigos_repositorios = \App\Http\Repositorys\RepositorioRepository::get_codigos();
    $codigos_usuarios = \App\Http\Repositorys\UserRepository::get_codigos();

    return [
        'codrepositorio' => $codigos_repositorios[rand(0,49)]->codrepositorio ,
        'codusuario' => $codigos_usuarios[rand(0,49)]->codusuario ,
        'nome' => $faker->company,
        'descricao' => $faker->sentence,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
