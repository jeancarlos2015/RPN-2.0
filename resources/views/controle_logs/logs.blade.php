
@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',['titulo' => 'Todos os modelos'])

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $logs,
                    'rota_exclusao' => 'controle_logs.destroy',
                    'titulo' =>'Logs Do Sistema'
    ])


@endsection

@section('modo')
    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Todos os Logs',
    'descricao' => 'Todos os Logs'
    ])
@endsection