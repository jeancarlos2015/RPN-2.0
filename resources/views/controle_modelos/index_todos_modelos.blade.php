{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}

    {{--<h4>Modelos Cadastrados No Sistema</h4>--}}

    {{--<br>--}}
    {{--$dados--}}
    {{--$titulos--}}
    {{--$rota_cricao--}}

    {{--@include('componentes.tabela_todos',--}}
                                {{--[--}}
                                {{--'titulos' => $titulos,--}}
                                {{--'dados' => $modelos,--}}
                                {{--'rota_exibicao' => 'controle_modelos.show',--}}
                                {{--'nomebotao' => 'Visualizar Modelo',--}}
                                {{--'rota_exclusao' => 'controle_modelos.destroy'--}}
                                {{--])--}}
{{--@endsection--}}



@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',['titulo' => 'Todos os modelos'])

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_exclusao' => 'controle_modelos.destroy',
                    'rota_exibicao' => 'controle_modelos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection