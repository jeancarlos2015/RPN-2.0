@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Edição',
                    'rota' => 'todas_regras'
    ])
    <form action="{!! route('controle_regras.update',['id' => $regra->codregra]) !!}" method="post">
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
