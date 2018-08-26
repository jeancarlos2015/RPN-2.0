@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
      'titulo' => 'Painel',
    'sub_titulo' => 'Repositório/'.$repositorio->nome.'/Novo Projeto',
    'rota' => 'painel'
    ])
    @includeIf('controle_atribuicao_projeto_usuarios.componentes.form_atribuicao_projeto_usuario_create')
    @if(!empty($atribuicao_projeto_usuario))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O grupo já existe, para acessá-lo clique neste <a href="{!! route('controle_atribuicao_projeto_usuarios.show',[$atribuicao_projeto_usuario->$codatribuicaoprojetousuario]) !!}" class="link">Link</a>.
        </div>
    @endif
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Grupos',
        'nome_titulo_menu' => 'Controle de Grupos'
    ])
@endsection