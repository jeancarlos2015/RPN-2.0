@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório/'.$repositorio->nome.'/Grupos/'.$atribuicao_projeto_usuario->nome,
                    'rota' => 'todos_grupos'
    ])
    @includeIf('controle_atribuicao_projeto_usuarios.componentes.form_atribuicao_projeto_usuario_update')
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Grupos',
        'nome_titulo_menu' => 'Controle de Grupos'
    ])
@endsection