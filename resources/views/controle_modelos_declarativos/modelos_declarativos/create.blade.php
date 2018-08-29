@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo Declarativo'
   ])
   @includeIf('controle_modelos_declarativos.modelos_declarativos.componentes.form_create')
    @if(!empty($modelo))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O modelo já existe, para acessá-lo clique neste <a href="{!! route('controle_modelos_declarativos.show',[$modelo->cod_modelo_declarativo]) !!}" class="link">Link</a>.
        </div>
    @endif
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Criação do modelo declarativo',
        'nome_titulo_menu' => 'Criação do Modelo Declarativo'
    ])
@endsection