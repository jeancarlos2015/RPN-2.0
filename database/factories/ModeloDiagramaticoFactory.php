<?php

use Faker\Generator as Faker;

//'nome',
//'descricao',
//'xml_modelo',
//
//'cod_projeto',
//'cod_repositorio',
//'codusuario',
//
//'visibilidade',
//'publico',
//'tipo'

$factory->define(\App\Http\Models\RepresentacaoDiagramatico::class, function (Faker $faker) {
    $projetos = \App\Http\Repositorys\ProjetoRepository::listar_projetos();
    $projeto = $projetos[rand(0,count($projetos)-1)];
    return [
        'nome' => $faker->name,
        'descricao' => 'Nenhum',
        'xml_modelo' => \App\Http\Models\RepresentacaoDiagramatico::get_modelo_default($faker->name),
        'cod_projeto' => $projeto->cod_projeto,
        'cod_repositorio' => $projeto->cod_repositorio,
        'codusuario' => $projeto->codusuario,
        'visibilidade' => 'true',
        'publico' => 'true',
        'tipo' => 'bpmn'
    ];

});
