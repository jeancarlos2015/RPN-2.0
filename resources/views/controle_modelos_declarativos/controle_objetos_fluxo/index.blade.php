
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Objetos De Fluxo',
                    'rota' => 'painel'
    ])
    @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $objetos_fluxos,
                    'rota_edicao' => 'controle_regras.edit',
                    'rota_exclusao' => 'controle_regras.destroy',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Regras'
    ])
@endsection
