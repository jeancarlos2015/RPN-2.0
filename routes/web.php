<?php

Auth::routes();

//Route::get('/repositorios_publicos', function () {
//    $repositorios_publicos = \App\Http\Repositorys\RepositorioRepository::listar_repositorios_publicos();
//    $titulos = \App\http\Models\Repositorio::titulos_da_tabela();
//    $tipo = 'repositorio_publico';
////    dd($repositorios_publicos);
//    return view('repositorios_publicos', compact('repositorios_publicos','tipo','titulos'));
//})->name('repositorios_publicos');

Route::get('/', function () {
    return view('inicio');
})->name('/');

Route::get('/logout', function () {
    return view('inicio');
})->name('logout');

Route::prefix('admin')->middleware(['auth'])->group(
    function () {

        Route::post('edicao_modelo_diagramatico/gravar', 'ModeloDiagramaticoController@gravar')
            ->name('gravar')
            ->middleware('can:acesso');

        Route::get('edicao_modelo_diagramatico/{codmodelo}', 'ModeloDiagramaticoController@edicao_modelo_diagramatico')
            ->name('edicao_modelo_diagramatico')
            ->middleware('can:acesso');

        Route::resource('controle_objetos_fluxos', 'ObjetoFluxoController')
            ->middleware('can:acesso');

        Route::resource('controle_repositorios', 'RepositorioController')
            ->middleware('can:acesso');

        Route::resource('controle_projetos', 'ProjetoController')
            ->middleware('can:acesso');

        Route::resource('controle_modelos_diagramaticos', 'ModeloDiagramaticoController')
            ->middleware('can:acesso');

        Route::get('controle_modelos_declarativos_create/repositorio/{codrepositorio}/projeto/{codprojeto}','ModeloDeclarativoController@create')
            ->name('controle_modelos_declarativos')
            ->middleware('can:acesso');

        Route::get('controle_objetos_fluxos_create/modelo/{codmodelodeclarativo}','ObjetoFluxoController@create')
            ->name('controle_objetos_fluxos_create')
            ->middleware('can:acesso');

        Route::resource('controle_modelos_declarativos', 'ModeloDeclarativoController')
            ->middleware('can:acesso');


        Route::resource('controle_usuarios', 'UserController')
            ->middleware('can:admin');

        Route::get('controle_usuarios_edit/{codusuario}', 'UserController@edit')
            ->name('controle_usuarios_edit')
            ->middleware('can:admin');

        Route::post('vincular_usuario_repositorio', 'RepositorioController@vincular_usuario_repositorio')
            ->name('vincular_usuario_repositorio')
            ->middleware('can:admin');

        Route::post('desvincular_usuario_repositorio','RepositorioController@desvincular_usuario_repositorio')
            ->name('desvincular_usuario_repositorio')
            ->middleware('can:admin');

        Route::get('vinculo_usuario_repositorio', 'RepositorioController@vinculo_usuario_repositorio')
            ->name('vinculo_usuario_repositorio')
            ->middleware('can:admin');


        Route::resource('controle_logs', 'LogController')
            ->middleware('can:admin');

        Route::get('index_logs', 'LogController@index')
            ->name('index_logs')
            ->middleware('can:acesso');

        Route::resource('controle_documentacoes', 'DocumentacaoController')
            ->middleware('can:acesso');


        Route::resource('controle_github', 'UsuarioGithubController')
            ->middleware('can:acesso');

        Route::get('create_github/usuario/{codusuario}', 'UsuarioGithubController@create')
            ->name('create_github')
            ->middleware('can:acesso');


        Route::get('controle_projetos_index/repositorio/{codrepositorio}', 'ProjetoController@index')
            ->name('controle_projetos_index')
            ->middleware('can:acesso');


        Route::get('todos_modelos', 'ModeloDiagramaticoController@todos_modelos')
            ->name('todos_modelos')
            ->middleware('can:acesso');

        Route::get('todos_projetos', 'ProjetoController@todos_projetos')
            ->name('todos_projetos')
            ->middleware('can:acesso');


        Route::get('controle_projetos_create/{codrepositorio}', 'ProjetoController@create')
            ->name('controle_projetos_create')
            ->middleware('can:acesso');

        Route::get('controle_modelos_diagramaticos_create/repositorio/{codrepositorio}/projeto/{codprojeto}', 'ModeloDiagramaticoController@create')
            ->name('controle_modelos_diagramaticos_create')
            ->middleware('can:acesso');

        Route::get('controle_modelos_declarativos_create/repositorio/{codrepositorio}/projeto/{codprojeto}', 'ModeloDeclarativoController@create')
            ->name('controle_modelos_declarativos_create')
            ->middleware('can:acesso');


        Route::get('controle_modelos_diagramaticos_index/repositorio/{codrepositorio}/projeto/{codprojeto}/usuario/{codusuario}', 'ModeloDiagramaticoController@index')
            ->name('controle_modelos_diagramaticos_index')
            ->middleware('can:acesso');;


        Route::get('controle_modelos_declarativos_index/repositorio/{codrepositorio}/projeto/{codprojeto}/usuario/{codusuario}', 'ModeloDeclarativoController@index')
            ->name('controle_modelos_declarativos_index')
            ->middleware('can:acesso');;


        Route::post('escolhe_modelo', 'ModeloDiagramaticoController@escolhe_modelo')
            ->name('escolhe_modelo')
            ->middleware('can:acesso');


        //Versionamento
        Route::resource('controle_versao', 'GitController')
            ->middleware('can:acesso');

        Route::post('init', 'GitController@init')
            ->name('init')
            ->middleware('can:acesso');

        Route::post('create', 'GitController@create')
            ->name('create')
            ->middleware('can:acesso');

        Route::post('commit', 'GitController@commit')
            ->name('commit')
            ->middleware('can:acesso');

        Route::get('pull', 'GitController@pull')
            ->name('pull')
            ->middleware('can:acesso');

        Route::post('merge_checkout', 'GitController@merge_checkout')
            ->name('merge_checkout')
            ->middleware('can:acesso');

        Route::post('delete', 'GitController@delete')
            ->name('delete')
            ->middleware('can:acesso');

        Route::get('delete_repository/repositorio/{repositorio_atual}/{default_branch}', 'GitController@delete_repository')
            ->name('delete_repository')
            ->middleware('can:acesso');

        Route::post('update_repository', 'GitController@update_repository')
            ->name('update_repository')
            ->middleware('can:acesso');

        Route::get('index_reset_files', 'GitController@index_reset_files')
            ->name('index_reset_files')
            ->middleware('can:acesso');

        Route::get('index_init', 'GitController@index_init')
            ->name('index_init')
            ->middleware('can:acesso');

        Route::get('index_painel', 'GitController@index')
            ->name('index_painel')
            ->middleware('can:acesso');

        Route::get('index_merge_checkout', 'GitController@index_merge_checkout')
            ->name('index_merge_checkout')
            ->middleware('can:acesso');

        Route::get('index_create_delete', 'GitController@index_create_delete')
            ->name('index_create_delete')
            ->middleware('can:acesso');

        Route::get('index_commit_branch', 'GitController@index_commit_branch')
            ->name('index_commit_branch')
            ->middleware('can:acesso');

        Route::get('index_pull_push', 'GitController@index_pull_push')
            ->name('index_pull_push')
            ->middleware('can:acesso');

        Route::get('selecionar_repositorio/repositorio/{repositorio_atual}/bramch/{default_branch}', 'GitController@selecionar_repositorio')
            ->name('selecionar_repositorio')
            ->middleware('can:acesso');


        Route::get('pagina_inicializacao_repositorio', 'GitController@pagina_inicializacao_repositorio')
            ->name('pagina_inicializacao_repositorio')
            ->middleware('can:acesso');

        Route::get('painel', 'RepositorioController@painel')
            ->name('painel');

    });
