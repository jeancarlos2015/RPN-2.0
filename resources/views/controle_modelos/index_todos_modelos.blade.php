@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Painel/Todos Modelos / Modelos'
   ])

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_exclusao' => 'controle_modelos.destroy',
                    'rota_exibicao' => 'controle_modelos.show',
                    'rota_edicao' => 'controle_modelos.edit',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection
