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
    $projetos = \App\Http\Repositorys\ProjetoRepository::listar_projetos();
    $projeto = $projetos[rand(0,count($projetos)-1)];
    return [
        'nome' => $faker->sentence,
        'descricao'=> 'Nenhum',
        'codprojeto' => $projeto->codprojeto ,
        'codrepositorio' => $projeto->codrepositorio ,
        'codusuario' => $projeto->codusuario ,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
