
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
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
        'codorganizacao' => $organizacao->codorganizacao
        ]
        )
    </form>
@endsection
