<?php

Auth::routes();

Route::get('/', function () {
    return view('inicio');
})->name('/');

Route::get('/logout', function () {
    return view('inicio');
})->name('logout');

Route::prefix('admin')->middleware(['auth'])->group(
    function () {

        Route::post('edicao_modelo_diagramatico/gravar', 'DadoXmlController@gravar')->name('gravar');
        Route::get('edicao_modelo_diagramatico/{codmodelo}', 'ModeloController@edicao_modelo_diagramatico')->name('edicao_modelo_diagramatico');


        Route::resource('controle_organizacoes', 'OrganizacaoController')
            ->middleware('can:acesso');
        Route::resource('controle_tarefas', 'TarefaController')
            ->middleware('can:acesso');
        Route::resource('controle_projetos', 'ProjetoController')
            ->middleware('can:acesso');
        Route::resource('controle_modelos', 'ModeloController')
            ->middleware('can:acesso');
        Route::resource('controle_regras', 'RegraController')
            ->middleware('can:acesso');


        Route::resource('controle_usuarios', 'UserController')
            ->middleware('can:admin');

        Route::post('vincular_usuario_organizacao', 'UserController@vincular_usuario_organizacao')
            ->name('vincular_usuario_organizacao')
            ->middleware('can:admin');

   Route::get('vinculo_usuario_organizacao', 'UserController@vinculo_usuario_organizacao')
            ->name('vinculo_usuario_organizacao')
            ->middleware('can:admin');


        Route::resource('controle_logs', 'LogController')
            ->middleware('can:admin');
        Route::get('index_logs', 'LogController@index')
            ->name('index_logs')
            ->middleware('can:acesso');;

        Route::resource('controle_documentacoes', 'DocumentacaoController');


        Route::resource('controle_github', 'UsuarioGithubController')
            ->middleware('can:acesso');

        Route::get('create_github/usuario/{codusuario}', 'UsuarioGithubController@create')
            ->name('create_github')
            ->middleware('can:acesso');


        Route::get('controle_projetos_index/organizacao{codorganizacao}', 'ProjetoController@index')
            ->name('controle_projetos_index')
            ->middleware('can:acesso');

        Route::get('show_tarefas/modelo/{codmodelo}', 'ModeloController@show_tarefas')
            ->name('show_tarefas')
            ->middleware('can:acesso');
        Route::get('show_regras/modelo/{codmodelo}', 'ModeloController@show_regras')
            ->name('show_regras')
            ->middleware('can:acesso');

        Route::get('todos_modelos', 'ModeloController@todos_modelos')
            ->name('todos_modelos')
            ->middleware('can:acesso');
        Route::get('todos_projetos', 'ProjetoController@todos_projetos')
            ->name('todos_projetos')
            ->middleware('can:acesso');
        Route::get('todas_tarefas', 'TarefaController@todas_tarefas')
            ->name('todas_tarefas')
            ->middleware('can:acesso');
        Route::get('todas_regras', 'RegraController@todas_regras')
            ->name('todas_regras')
            ->middleware('can:acesso');


        Route::get('controle_projetos_create/{codorganizacao}', 'ProjetoController@create')
            ->name('controle_projetos_create')
            ->middleware('can:acesso');

        Route::get('controle_modelos_create/organizacao/{codorganizacao}/projeto/{codprojeto}', 'ModeloController@create')
            ->name('controle_modelos_create')
            ->middleware('can:acesso');
        Route::get('controle_modelos_index/organizacao/{codorganizacao}/projeto/{codprojeto}/usuario/{codusuario}', 'ModeloController@index')
            ->name('controle_modelos_index')
            ->middleware('can:acesso');;
        Route::get('controle_tarefas_index/organizacao/{codorganizacao}/projeto/{codprojeto}/modelo/{codmodelo}', 'TarefaController@index')
            ->name('controle_tarefas_index')
            ->middleware('can:acesso');
        Route::get('controle_tarefas_create/organizacao{codorganizacao}/projeto/{codprojeto}/modelo/{codmodelo}/regra/{codregra}', 'TarefaController@create')
            ->name('controle_tarefas_create')
            ->middleware('can:acesso');
        Route::get('controle_regras_create/organizacao/{codorganizacao}/projeto/{codprojeto}/modelo/{codmodelo}', 'RegraController@create')
            ->name('controle_regras_create')
            ->middleware('can:acesso');
        Route::get('controle_regras_index/organizacao/{codorganizacao}/projeto/{codprojeto}/modelo/{codmodelo}', 'RegraController@index')
            ->name('controle_regras_index')
            ->middleware('can:acesso');
        Route::post('escolhe_modelo', 'ModeloController@escolhe_modelo')
            ->name('escolhe_modelo')
            ->middleware('can:acesso');


        //Versionamento
        Route::resource('controle_versao', 'GitController');
        Route::post('init', 'GitController@init')->name('init');
        Route::post('create', 'GitController@create')->name('create');
        Route::post('commit', 'GitController@commit')->name('commit');
        Route::get('pull', 'GitController@pull')->name('pull');

        Route::post('merge_checkout', 'GitController@merge_checkout')->name('merge_checkout');
        Route::post('delete', 'GitController@delete')->name('delete');
        Route::get('delete_repository/repositorio/{repositorio_atual}/{default_branch}', 'GitController@delete_repository')->name('delete_repository');
        Route::post('update_repository', 'GitController@update_repository')->name('update_repository');

        Route::get('index_reset_files', 'GitController@index_reset_files')->name('index_reset_files');

        Route::get('index_init', 'GitController@index_init')->name('index_init');
        Route::get('index_painel', 'GitController@index')->name('index_painel');
        Route::get('index_merge_checkout', 'GitController@index_merge_checkout')->name('index_merge_checkout');
        Route::get('index_create_delete', 'GitController@index_create_delete')->name('index_create_delete');
        Route::get('index_commit_branch', 'GitController@index_commit_branch')->name('index_commit_branch');
        Route::get('index_pull_push', 'GitController@index_pull_push')->name('index_pull_push');
        Route::get('selecionar_repositorio/repositorio/{repositorio_atual}/bramch/{default_branch}', 'GitController@selecionar_repositorio')->name('selecionar_repositorio');


        Route::get('pagina_inicializacao_repositorio', 'GitController@pagina_inicializacao_repositorio')->name('pagina_inicializacao_repositorio');

        Route::get('painel', 'OrganizacaoController@painel')->name('painel');

    });
