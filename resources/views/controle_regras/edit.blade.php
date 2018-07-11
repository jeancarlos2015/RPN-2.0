{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
{{--@includeIf('componentes.dados_exibicao')--}}
{{--<hr>--}}
{{--<h3>Editar Regra</h3>--}}
{{--<form action="{!! route('controle_regras.update',['id' => $regra->id]) !!}" method="post">--}}
{{--{{ method_field('PUT')}}--}}
{{--@includeIf('controle_regras.form',--}}
{{--[--}}
{{--'acao' => 'Atualizar',--}}
{{--'dados' => $dados,--}}
{{--'MAX' => 4,--}}
{{--'id' => $regra->id--}}
{{--]--}}
{{--)--}}
{{--</form>--}}
{{--@endsection--}}


@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Regras',
                    'rota' => 'todas_regras'
    ])
    <form action="{!! route('controle_regras.update',['id' => $regra->id]) !!}" method="post">
        {{ method_field('PUT')}}
        @includeIf('controle_regras.form',
        [
        'acao' => 'Atualizar',
        'dados' => $dados,
        'MAX' => 4,
        'regra' => $regra
        ]
        )
    </form>
@endsection