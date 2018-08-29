
@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo BPMN'
   ])
   @includeIf('controle_modelos_diagramaticos.componentes.form_diagramatico_create')
    @if(!empty($modelo))
        <div class="alert alert-warning">
            <strong>Warning!</strong> O modelo já existe, para acessá-lo clique neste <a href="{!! route('controle_modelos_diagramaticos.edit',[$modelo->cod_modelo_diagramatico]) !!}" class="link">Link</a>.
        </div>
    @endif
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Você está no modo de Edição de modelo. As alterações que você fizer aqui deverão ser salvas.',
        'nome_titulo_menu' => 'Modo De Criação Do Modelo BPMN'
    ])
@endsection