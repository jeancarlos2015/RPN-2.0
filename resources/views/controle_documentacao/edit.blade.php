@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Documentações',
                    'rota' => 'painel'
    ])

    <form action="{!! route('controle_documentacoes.update',[$documentacao->coddocumentacao]) !!}" method="POST">
        @method('PUT')
        @includeIf('controle_documentacao.form',['acao' => 'Atualizar','dados' => $dados,'MAX' => 3])
    </form>

@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Edição da documentação</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection