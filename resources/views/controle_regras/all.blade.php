@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',['titulo' => 'Regras'])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'tarefas' => $regras,
                    'rota_exclusao' => 'controle_tarefas.destroy',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Regras'
    ])
@endsection