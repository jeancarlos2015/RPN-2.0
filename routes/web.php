<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return view('inicio');
})->name('/');

Route::prefix('admin')->middleware(['auth'])->group(
    function () {

        Route::resource('controle_organizacoes', 'OrganizacaoController');
        Route::resource('controle_tarefas', 'TarefaController');
        Route::resource('controle_projetos', 'ProjetoController');
        Route::resource('controle_modelos', 'ModeloController');
        Route::resource('controle_regras', 'RegraController');



        Route::get('controle_projetos_index/{organizacao_id}', 'ProjetoController@index')->name('controle_projetos_index');
        Route::get('show_tarefas/{modelo_id}', 'ModeloController@show_tarefas')->name('show_tarefas');
        Route::get('show_regras/{modelo_id}', 'ModeloController@show_regras')->name('show_regras');

        Route::get('todos_modelos', 'ModeloController@todos_modelos')->name('todos_modelos');
        Route::get('todos_projetos', 'ProjetoController@todos_projetos')->name('todos_projetos');
        Route::get('todas_tarefas', 'TarefaController@todas_tarefas')->name('todas_tarefas');
        Route::get('todas_regras', 'RegraController@todas_regras')->name('todas_regras');
        Route::get('controle_versao_projetos', 'VersionadorController@index')->name('controle_versao_projetos');


        Route::get('controle_projetos_create/{organizacao_id}', 'ProjetoController@create')->name('controle_projetos_create');
        Route::get('controle_modelos_create/{organizacao_id}/{projeto_id}', 'ModeloController@create')->name('controle_modelos_create');
        Route::get('controle_modelos_index/{organizacao_id}/{projeto_id}', 'ModeloController@index')->name('controle_modelos_index');
        Route::get('controle_tarefas_index/{organizacao_id}/{projeto_id}/{modelo_id}', 'TarefaController@index')->name('controle_tarefas_index');
        Route::get('controle_tarefas_create/{organizacao_id}/{projeto_id}/{modelo_id}', 'TarefaController@create')->name('controle_tarefas_create');
        Route::get('controle_regras_create/{organizacao_id}/{projeto_id}/{modelo_id}', 'RegraController@create')->name('controle_regras_create');
        Route::get('controle_regras_index/{organizacao_id}/{projeto_id}/{modelo_id}', 'RegraController@index')->name('controle_regras_index');
        Route::post('escolhe_modelo', 'ModeloController@escolhe_modelo')->name('escolhe_modelo');


        //Versionamento

        Route::get('init', 'GitController@init')->name('init');
        Route::post('create_branch', 'GitController@create_branch')->name('create');
        Route::post('commit', 'GitController@commit')->name('commit');
        Route::post('checkout', 'GitController@checkout')->name('checkout');
        Route::post('merge', 'GitController@merge')->name('merge');
        Route::post('delete', 'GitController@delete')->name('delete');

        Route::resource('controle_versao', 'GitController');


        Route::get('pagina_inicializacao_repositorio', 'GitController@pagina_inicializacao_repositorio')->name('pagina_inicializacao_repositorio');

        Route::get('painel', 'OrganizacaoController@painel')->name('painel');

    });
