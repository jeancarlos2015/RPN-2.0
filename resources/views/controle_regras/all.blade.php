@extends('layouts.admin.layouts.main')
@section('content')
    @if(!empty($repositorio) || Auth::user()->email==='jeancarlospenas25@gmail.com')
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' =>
                        'Todas as Regras'
                        ,
                        'rota' => 'painel'
        ])
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $regras,
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Regras'
    ])


    @endif

@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de projetos',
        'nome_titulo_menu' => 'Controle de projetos'
    ])
@endsection