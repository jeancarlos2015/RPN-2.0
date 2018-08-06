
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'rota' => 'painel',
                    'sub_titulo' => 'Modelos'
    ])

    @if(!empty($organizacao))
        @if(Auth::user()->email===$organizacao->usuario->email)
            @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
        @endif
    @endif
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_edicao' => 'controle_modelos.edit',
                    'rota_exclusao' => 'controle_modelos.destroy',
                    'rota_cricao' => 'controle_modelos.create',
                    'rota_exibicao' => 'controle_modelos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection
