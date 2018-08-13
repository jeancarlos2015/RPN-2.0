
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo Declarativo'
   ])
    <form action="{!! route('controle_modelos_declarativos.store') !!}" method="post">
    @includeIf('controle_modelos_declarativos.modelos_declarativos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codrepositorio' => $repositorio->codrepositorio,
    'codprojeto' => $projeto->codprojeto
    ])
    </form>

@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Criação do Modelo Declarativo</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection