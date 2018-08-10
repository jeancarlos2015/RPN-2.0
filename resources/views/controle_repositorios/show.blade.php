@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Organizacoes',
                    'rota' => 'painel'
    ])

    <h3>Visualização da organização</h3>
@endsection
