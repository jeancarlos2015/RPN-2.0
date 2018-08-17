@extends('layouts.admin.layouts.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Configuracao Do Versionamento',
                    'rota' => 'painel',
                    'branch_atual' => $branch_atual
    ])
    @includeIf('controle_github.componentes.form_create')
    @includeIf('controle_github.componentes.form_delete')

@endsection

@section('modo')
    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Configuração Github',
    'descricao' => 'Configuração Github'
    ])
@endsection