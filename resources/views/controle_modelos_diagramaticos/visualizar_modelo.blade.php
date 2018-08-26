@extends('controle_modelos_diagramaticos.layout_diagrama_visualizacao.main')

@section('canvas_visualizacao')

    <div id="canvas"></div>
@endsection
@section('modo')

    @includeIf('componentes.descricao',[
            'descricao_titulo_menu' => 'Você está no modo de Visualização de modelo. As alterações que você fizer aqui deverão ser salvas.',
            'nome_titulo_menu' => 'Modo de Visualização do Modelo'
        ])
@endsection
@section('boltao_voltar')

    <li class="nav-item">

        <a class="nav-link"
           href="{{ URL::previous() }}">
            <p class="fa fa-mail-reply"> Retornar</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection