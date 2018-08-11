@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Modelos',
                    'rota' => 'painel'
    ])
    <h3>Visualização Do Modelo</h3>
@endsection
