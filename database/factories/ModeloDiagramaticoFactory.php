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
        'codprojeto' => rand(1,100),
        'codrepositorio' => rand(1,100),
        'codusuario' => rand(1,2),
        'visibilidade' => 'true',
        'publico' => 'true',
        'tipo' => 'bpmn'
    ];
});
