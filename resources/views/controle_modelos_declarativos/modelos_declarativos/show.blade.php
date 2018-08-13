@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Modelos',
                    'rota' => 'painel'
    ])
@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Visualização Do Modelo Declarativo</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection