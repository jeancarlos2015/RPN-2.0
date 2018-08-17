@extends('layouts.admin.layouts.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório / '.$modelo_declarativo->repositorio->nome.
                                    '/ Projeto / '.$modelo_declarativo->projeto->nome.
                                    '/ Mode Declarativo / '.$modelo_declarativo->nome.
                                    '/ Novo Objeto de Fluxo / ',
                    'rota' => 'controle_objetos_fluxos.index'
    ])
    @includeIf('controle_modelos_declarativos.controle_regras.componentes.form_create')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Nesta página você vai aplicar os padrões de recomendação no modelo de clarativo',
        'nome_titulo_menu' => 'Modo de Criação das Regras'
    ])
@endsection

