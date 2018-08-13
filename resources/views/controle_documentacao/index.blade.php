@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',
    [
    'titulo' => 'Todos as documentações'
    ])

    @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
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
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Visualização da documentação</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection
