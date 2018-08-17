@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'painel',
                    'branch_atual' => $branch_atual
    ])
    @if(!empty($repositorios))
        @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
            @includeIf('controle_versao.componentes.form_criacao')
            @includeIf('layouts.admin.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'nome_botao' => 'Novo',
                                'titulo' =>'Repositórios'
                ])
        @else
            @includeIf('layouts.admin.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'titulo' =>'Repositórios'
                ])
        @endif
    @endif
@endsection
