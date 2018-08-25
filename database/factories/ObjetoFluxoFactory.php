<?php

use Faker\Generator as Faker;

//'codrepositorio',
//'codusuario',
//'codprojeto',
//'codmodelodeclarativo',
//'codregra',
//'nome',
//'descricao',
//'tipo',
//'visivel_projeto',
//'visivel_modelo_declarativo',
//'visivel_repositorio'


$factory->define(\App\http\Models\ObjetoFluxo::class, function (Faker $faker) {
    $codigos_repositorios = \App\Http\Repositorys\RepositorioRepository::get_codigos();
    $codigos_usuarios = \App\Http\Repositorys\UserRepository::get_codigos();
    $codigos_projetos = \App\Http\Repositorys\ProjetoRepository::get_codigos();
    $codigos_modelos = \App\Http\Repositorys\ModeloDeclarativoRepository::get_codigos();
    return [
        'codprojeto' => $codigos_projetos[rand(0,49)]->codprojeto ,
        'codrepositorio' => $codigos_repositorios[rand(0,49)]->codrepositorio ,
        'codusuario' => $codigos_usuarios[rand(0,49)]->codusuario ,
        'codmodelodeclarativo' => $codigos_modelos[rand(0,49)]->codmodelodeclarativo ,
        'codregra' => null,
        'nome' => $faker->word,
        'descricao' => $faker->sentence,
        'tipo' => \App\http\Models\ObjetoFluxo::tipos()[rand(0,5)],
        'visivel_projeto' => 'true',
        'visivel_modelo_declarativo' => 'true',
        'visivel_repositorio' => 'true'
    ];
});
