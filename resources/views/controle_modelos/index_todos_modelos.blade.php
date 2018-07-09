@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}

    <h4>Modelos Cadastrados No Sistema</h4>

    <br>
    {{--$dados--}}
    {{--$titulos--}}
    {{--$rota_cricao--}}

    @include('componentes.tabela_todos',
                                [
                                'titulos' => $titulos,
                                'dados' => $modelos,
                                'rota_exibicao' => 'controle_modelos.show',
                                'nomebotao' => 'Visualizar Modelo',
                                'rota_exclusao' => 'controle_modelos.destroy'
                                ])
@endsection