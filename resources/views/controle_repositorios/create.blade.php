@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Nova Organização'
   ])

    <form action="{!! route('controle_repositorios') !!}" method="post">
        {{ method_field('POST')}}
        @includeIf('controle_repositorios.form',
        [
        'acao' => 'Salvar e Proseguir',
        'dados' => $dados,
        'MAX' => 2
        ])
    </form>

@endsection
