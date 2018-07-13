@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Paianel',
                    'sub_titulo' => 'Organizacoes',
                    'rota' => 'controle_organizacoes.index'
    ])

    @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'organizacoes' => $organizacoes,
                    'rota_edicao' => 'controle_organizacoes.edit',
                    'rota_exclusao' => 'controle_organizacoes.destroy',
                    'rota_cricao' => 'controle_organizacoes.create',
                    'rota_exibicao' => 'controle_organizacoes.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Organizações'

    ])

@endsection