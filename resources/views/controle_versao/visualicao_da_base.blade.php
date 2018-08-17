@extends('layouts.admin.layouts.main')

@section('content')
    @if(!empty($repositorio))
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',
                        'sub_titulo' => 'Versionamento',
                        'rota' => 'index_painel',
                        'branch_atual' => $repositorio['default_branch']
        ])
    @includeIf('controle_versao.form_visualizacao')
    @endif
@endsection
