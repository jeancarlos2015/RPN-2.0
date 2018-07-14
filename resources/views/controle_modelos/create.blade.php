
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Modelos',
                    'rota' => 'todos_modelos'
    ])

    <form action="{!! route('controle_modelos.store') !!}" method="post">
    @includeIf('controle_modelos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codorganizacao' => $organizacao->codorganizacao,
    'codprojeto' => $projeto->codprojeto
    ])
    </form>

@endsection