@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo Declarativo'
   ])
    <form action="{!! route('controle_modelos_declarativos.store') !!}" method="post">
        @csrf
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
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Criação do modelo declarativo',
        'nome_titulo_menu' => 'Criação do Modelo Declarativo'
    ])
@endsection