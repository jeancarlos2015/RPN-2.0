@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Repositórios',
                    'rota' => 'painel'
    ])

    <h3>Visualização do Repositório</h3>
@endsection
