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

@section('boltao_voltar')

    <li class="nav-item">

            <a class="nav-link"
               href="{{ URL::previous() }}">
                <p class="fa fa-mail-reply"> Retornar</p>
                <span class="sr-only"></span>
            </a>
    </li>

@endsection


@section('codigo_js_bpmn')
    <script src="{{asset('bpmn/bpmn.js')}}"></script>
    {{--<script src="{{asset('bpmn-app/dist/app.js')}}"></script>--}}
@endsection
