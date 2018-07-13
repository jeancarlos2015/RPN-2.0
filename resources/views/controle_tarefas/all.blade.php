@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
      'titulo' => 'Paianel',
      'sub_titulo' => 'Tarefas',
    ])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'tarefas' => $tarefas,
                    'rota_exclusao' => 'controle_tarefas.destroy',
                    'rota_edicao' => 'controle_tarefas.edit',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Tarefas'
    ])
@endsection