@extends('layouts.admin.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Painel/Todos Modelos / Modelos'
   ])

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_exclusao' => 'controle_modelos_diagramaticos.destroy',
                    'rota_exibicao' => 'controle_modelos_diagramaticos.show',
                    'rota_edicao' => 'controle_modelos_diagramaticos.edit',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
            'descricao_titulo_menu' => 'Visualização dos modelos',
            'nome_titulo_menu' => 'Visualização dos modelos'
        ])
@endsection