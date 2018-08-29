@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' =>
                    'Repositório/'.
                    $regra->repositorio->nome.
                    '/Projetos/'.
                    $regra->projeto->nome.
                    '/Modelo/'.
                    $regra->modelodeclarativo->nome.
                    '/Regra/'.
                    $regra->cod_regra,
                    'rota' => 'painel'
    ])
    <form action="{!! route('controle_regras.update',[$regra->cod_regra]) !!}" method="post">
        @method('PUT')
        @csrf
        @includeIf('controle_regras.form',[
        'MAX' => 1,
         'acao' => 'Atualizar Regra'
        ])
    </form>


@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de projetos',
        'nome_titulo_menu' => 'Controle de projetos'
    ])
@endsection