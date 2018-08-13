@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
    'titulo' => 'Painel',
    'sub_titulo' => ''

    ])

    @includeIf('layouts.layout_admin_new.componentes.cards')


@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Painel Principal</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection