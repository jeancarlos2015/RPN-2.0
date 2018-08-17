@extends('layouts.admin.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Objetos De Fluxo',
                    'rota' => 'painel'
    ])
    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $objetos_fluxos,
                    'rota_exibicao' => 'controle_objetos_fluxos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Regras'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Edição de Objeto de Fluxo',
        'nome_titulo_menu' => 'Controle de Objetos de fluxo'
    ])
@endsection