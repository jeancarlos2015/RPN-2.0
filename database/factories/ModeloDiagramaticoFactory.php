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
    $codigos_repositorios = \App\Http\Repositorys\RepositorioRepository::get_codigos();
    $codigos_usuarios = \App\Http\Repositorys\UserRepository::get_codigos();
    $codigos_projetos = \App\Http\Repositorys\ProjetoRepository::get_codigos();
    return [
        'nome' => $faker->name,
        'descricao' => 'Nenhum',
        'xml_modelo' => \App\Http\Models\ModeloDiagramatico::get_modelo_default($faker->name),
        'codprojeto' => $codigos_projetos[rand(0,49)]->codprojeto ,
        'codrepositorio' => $codigos_repositorios[rand(0,49)]->codrepositorio ,
        'codusuario' => $codigos_usuarios[rand(0,49)]->codusuario ,
        'visibilidade' => 'true',
        'publico' => 'true',
        'tipo' => 'bpmn'
    ];
});
