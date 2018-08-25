@extends('layouts.admin.layouts.main')

@section('content')

    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório/'.$modelo_declarativo->repositorio->nome.
                                    '/Projeto/ '.$modelo_declarativo->projeto->nome.
                                    '/Declarativo/ '.$modelo_declarativo->nome.
                                    '/Novo Objeto de Fluxo',
                    'rota' => 'controle_objetos_fluxos.index'
    ])

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.form_create')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Nesta página você vai aplicar os padrões de recomendação no modelo de clarativo',
        'nome_titulo_menu' => 'Modo de Criação das Regras'
    ])
@endsection

{{--@section('codigo_css')--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">--}}
{{--@endsection--}}

{{--@section('codigo_js')--}}
    {{--<!-- Latest compiled and minified JavaScript -->--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>--}}
    {{--<!-- (Optional) Latest compiled and minified JavaScript translation files -->--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>--}}

{{--@endsection--}}