
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo Diagramatico'
   ])
    <form action="{!! route('controle_modelos_diagramaticos.store') !!}" method="post">
    @includeIf('controle_modelos_diagramaticos.form',
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
        'descricao_titulo_menu' => 'Você está no modo de Edição de modelo. As alterações que você fizer aqui deverão ser salvas.',
        'nome_titulo_menu' => 'Modo De Criação Do Modelo Diagramático'
    ])
@endsection