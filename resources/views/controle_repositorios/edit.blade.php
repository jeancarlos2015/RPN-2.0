@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Repositórios',
                    'rota' => 'controle_repositorios.index'
    ])

    <form action="{!! route('controle_repositorios.update',[$repositorio->codrepositorio]) !!}" method="POST">
    @method('PUT')
    @includeIf('controle_repositorios.form',['acao' => 'Atualizar e Proseguir','dados' => $dados,'MAX' => 2])
    </form>

@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Ediçãod e Repositório</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection