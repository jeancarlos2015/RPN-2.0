
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
      'titulo' => 'Painel',
    'sub_titulo' => 'Repositório/'.$repositorio->nome.'/Novo Projeto',
    'rota' => 'painel'
    ])
    <form action="{!! route('controle_projetos.store') !!}" method="post">
    @includeIf('controle_projetos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codrepositorio' => $repositorio->codrepositorio
    ]
    )
    </form>
@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Criação do Projeto</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection