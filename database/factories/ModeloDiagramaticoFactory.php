<?php

use Faker\Generator as Faker;

//'nome',
//'descricao',
//'xml_modelo',
//
//'codprojeto',
//'codrepositorio',
//'codusuario',
//
//'visibilidade',
//'publico',
//'tipo'

$factory->define(\App\Http\Models\ModeloDiagramatico::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => 'Nenhum',
        'xml_modelo' => \App\Http\Models\ModeloDiagramatico::get_modelo_default($faker->name),
        'codprojeto' => 1,
        'codrepositorio' => 1,
        'codusuario' => 1,
        'visibilidade' => 'true',
        'publico' => 'true',
        'tipo' => 'bpmn'
    ];
});
