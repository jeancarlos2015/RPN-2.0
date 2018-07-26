
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',['titulo' => 'Todos os modelos'])

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $logs,
                    'rota_exclusao' => 'controle_logs.destroy',
                    'titulo' =>'Logs Do Sistema'
    ])


@endsection
