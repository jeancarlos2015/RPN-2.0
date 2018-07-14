@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
      'titulo' => 'Paianel',
      'sub_titulo' => 'Regras',
    ])

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'tarefas' => $regras,
                    'rota_edicao' => 'controle_regras.edit',
                    'rota_exclusao' => 'controle_regras.destroy',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Regras'
    ])
@endsection