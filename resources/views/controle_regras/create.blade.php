{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}
    {{--@includeIf('componentes.dados_exibicao')--}}
    {{--<hr>--}}
    {{--<h3>Nova Regra</h3>--}}
    {{--<form action="{!! route('controle_regras.store') !!}" method="post">--}}
        {{--@includeIf('controle_regras.form',--}}
                   {{--[--}}
                   {{--'acao' => 'Criar Regra',--}}
                   {{--'dados' => $dados,--}}
                   {{--'MAX' => 4,--}}
                   {{--'projeto_id' => $projeto->id,--}}
                   {{--'modelo_id' => $modelo->id,--}}
                   {{--'organizacao_id' => $organizacao->id,--}}
                   {{--'tarefas' => $tarefas--}}
                   {{--]--}}
                   {{--)--}}
    {{--</form>--}}
{{--@endsection--}}


@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Regras',
                    'rota' => 'todas_regras'
    ])
    <form action="{!! route('controle_regras.store') !!}" method="post">
        @includeIf('controle_regras.form',
        [
        'acao' => 'Criar Regra',
        'dados' => $dados,
        'MAX' => 4,
        'codprojeto' => $projeto->codprojeto,
        'codmodelo' => $modelo->codmodelo,
        'codorganizacao' => $organizacao->codorganizacao,
        'tarefas' => $tarefas
        ]
        )
    </form>
@endsection