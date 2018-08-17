@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')
    @includeIf('controle_modelos_diagramaticos.componentes.canvas')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
            'descricao_titulo_menu' => 'Você está no modo de Edição de modelo. As alterações que você fizer aqui deverão ser salvas.',
            'nome_titulo_menu' => 'Modo de Edição do Modelo'
        ])
@endsection