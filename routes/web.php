<?php


Route::get('publico/modelos', function () {
    $titulos = \App\Http\Models\ModeloDiagramatico::titulos();
    $modelos = \App\Http\Repositorys\ModeloDiagramaticoRepository::listar_modelos_publicos();
    $tipo = 'publico';
    $contador=0;
    return view('modelos_publicos.index', compact('modelos', 'titulos', 'tipo','contador'));
})->name('modelos_publicos');

Route::get('publico/modelos/{codmodelo}',function ($codmodelo){
    $modelo = \App\Http\Models\ModeloDiagramatico::findOrFail($codmodelo);
    $path_modelo = public_path('novo_bpmn/');
    if (!file_exists($path_modelo)) {
        mkdir($path_modelo, 777);
    }
    $file = $path_modelo . 'novo.bpmn';
    file_put_contents($file, $modelo->xml_modelo);
    sleep(2);
    return view('modelos_publicos.visualizar_modelo',compact('modelo'));
})->name('visualizar_modelo_publico');


Route::get('/', function () {
    return view('inicio');
})->name('/');

Route::get('/home', function () {
    return view('inicio');
})->name('/home');

Route::get('/logout', function () {
    return view('inicio');
})->name('logout');

Route::get('admin/painel', function () {
    return view('inicio');
});

Route::get('email/index1', function () {
    return view('mails.email_cadastro_de_usuario');
});
Route::get('email/index2', function () {
    return view('mails.email_desvinculacao_de_usuario');
});
Route::get('email/index3', function () {
    return view('mails.email_vinculacao_de_usuario');
});





Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(
    function () {
        Route::get('todas_regras', 'RegraController@all')->name('todas_regras')
            ->middleware('can:acesso');

        Route::resource('controle_padroes_recomendacao', 'PadraoRecomendacaoController')
            ->middleware('can:acesso');

        Route::get('controle_padrao_create_binario/modelo_delcarativo/{codmodelodeclarativo}', 'PadraoRecomendacaoController@create_recomendacao_binario')
            ->name('controle_padrao_create_binario')
            ->middleware('can:acesso');

        Route::get('controle_padrao_create_conjunto/modelo_delcarativo/{codmodelodeclarativo}', 'PadraoRecomendacaoController@create_recomendacao_conjunto')
            ->name('controle_padrao_create_conjunto')
            ->middleware('can:acesso');

        Route::post('controle_padrao_salvar', 'PadraoRecomendacaoController@salvar')
            ->name('controle_padrao_salvar')
            ->middleware('can:acesso');

        Route::post('edicao_modelo_diagramatico/gravar', 'ModeloDiagramaticoController@gravar')
            ->name('gravar')
            ->middleware('can:acesso');


        Route::get('controle_objeto_fluxo_index/modelo_declarativo/{codmodelodeclarativo}', 'ObjetoFluxoController@controle_objeto_fluxo_index')
            ->name('controle_objeto_fluxo_index')
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

        Route::get('controle_modelos_declarativos_create/repositorio/{codrepositorio}/projeto/{codprojeto}', 'ModeloDeclarativoController@create')
            ->name('controle_modelos_declarativos')
            ->middleware('can:acesso');

        Route::get('controle_objetos_fluxos_create/modelo/{codmodelodeclarativo}', 'ObjetoFluxoController@create')
            ->name('controle_objetos_fluxos_create')
            ->middleware('can:acesso');

        Route::resource('controle_modelos_declarativos', 'ModeloDeclarativoController')
            ->middleware('can:acesso');

        Route::get('edicao_modelo_declarativo/{codmodelo}', 'ModeloDeclarativoController@edit')
            ->name('edicao_modelo_declarativo')
            ->middleware('can:acesso');


        Route::resource('controle_usuarios', 'UserController')
            ->middleware('can:admin');

        Route::get('controle_usuarios_edit/{codusuario}', 'UserController@edit')
            ->name('controle_usuarios_edit')
            ->middleware('can:admin');

        Route::post('vincular_usuario_repositorio', 'RepositorioController@vincular_usuario_repositorio')
            ->name('vincular_usuario_repositorio')
            ->middleware('can:admin');

        Route::post('desvincular_usuario_repositorio', 'RepositorioController@desvincular_usuario_repositorio')
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

        Route::post('criar_base', 'GitController@criar_base')
            ->name('criar_base')
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

        Route::get('edit_vinculo/{codusuario}', 'UserController@edit_vinculo')
            ->name('edit_vinculo')
            ->middleware('can:acesso');

        Route::resource('controle_regras', 'RegraController')
            ->middleware('can:acesso');
        Route::get('controle_regras_index/modelodeclarativo/{codmodelodeclarativo}', 'RegraController@index')
            ->name('controle_regras_index')
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
