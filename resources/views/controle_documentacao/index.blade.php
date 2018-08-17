@extends('layouts.admin.layouts.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',
    [
    'titulo' => 'Todos as documentações'
    ])

    @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'documentacoes' => $documentacoes,
                    'rota_edicao' => 'controle_documentacoes.edit',
                    'rota_exclusao' => 'controle_documentacoes.destroy',
                    'rota_cricao' => 'controle_documentacoes.create',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Documentações'

    ])


@endsection


@section('modo')

    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Edição da documentação',
    'descricao' => 'Visualização da documentação'
    ])
@endsection
