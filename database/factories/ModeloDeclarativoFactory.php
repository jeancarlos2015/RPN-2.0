<?php

use Faker\Generator as Faker;

//'nome',
//'descricao',
//'tipo',
//
//'cod_projeto',
//'cod_repositorio',
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
        'cod_projeto' => $projeto->cod_projeto ,
        'cod_repositorio' => $projeto->cod_repositorio ,
        'codusuario' => $projeto->codusuario ,
        'visibilidade' => 'true',
        'publico' => 'true'
    ];
});
