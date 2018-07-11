@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',['titulo' => 'Tarefas'])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'tarefas' => $tarefas,
                    'rota_exclusao' => 'controle_tarefas.destroy',
                    'rota_exibicao' => 'controle_tarefas.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Tarefas'
    ])
@endsection