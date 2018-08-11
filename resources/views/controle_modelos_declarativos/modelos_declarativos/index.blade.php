
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'rota' => 'painel',
                    'sub_titulo' => 'Repositório/'.$repositorio->nome.'Projetos/'.$projeto->nome.'/Modelos'
    ])
    @if(!empty($repositorio))
            @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @endif
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_edicao' => 'controle_modelos_diagramaticos.edit',
                    'rota_exclusao' => 'controle_modelos_diagramaticos.destroy',
                    'rota_cricao' => 'controle_modelos_diagramaticos.create',
                    'rota_exibicao' => 'controle_modelos_diagramaticos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection
