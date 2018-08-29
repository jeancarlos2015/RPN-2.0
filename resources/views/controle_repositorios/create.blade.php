@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Novo Repositório'
   ])

    @includeIf('controle_repositorios.componentes.form_repositorio_create')

    @if(!empty($repositorio))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O repositório já existe, para acessá-lo clique neste <a href="{!! route('controle_repositorios.show',[$repositorio->cod_repositorio]) !!}" class="link">Link</a>.
        </div>
    @endif
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Repositórios',
        'nome_titulo_menu' => 'Modo de Criação do Repositório'
    ])
@endsection