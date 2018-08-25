@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')

<div id="canvas"></div>
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
            'descricao_titulo_menu' => 'Você está no modo de visualização de modelo. As alterações que você fizer aqui não poderão ser salvas.',
            'nome_titulo_menu' => 'Modo De Visualização Do Modelo'
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