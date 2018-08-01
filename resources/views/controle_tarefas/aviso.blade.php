@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Aviso',
                    'sub_titulo' => 'Tela em desenvolvimento',
                    'rota' => 'painel'
    ])
    <h1>Tela em desenvolvimento</h1>

@endsection
