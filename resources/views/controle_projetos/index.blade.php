@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Projetos',
                    'rota' => 'painel'
    ])
    @if(!empty($organizacao))

        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])

    @endif

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'projetos' => $projetos,
                    'rota_edicao' => 'controle_projetos.edit',
                    'rota_exclusao' => 'controle_projetos.destroy',
                    'rota_cricao' => 'controle_projetos.create',
                    'rota_exibicao' => 'controle_projetos.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Projetos'
    ])
@endsection
