
@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Atualizar Objeto de Fluxo',
                    'rota' => 'controle_objetos_fluxos.index'
    ])
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.form_update')
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.links_padroes_recomendacao')

@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Edição de Objeto de Fluxo',
        'nome_titulo_menu' => 'Controle de Objetos de fluxo'
    ])
@endsection