{{--@extends('layouts.admin.layouts.main')--}}
{{--@section('content')--}}
{{--@includeIf('layouts.admin.componentes.breadcrumb',[--}}
{{--'titulo' => 'Painel',--}}
{{--'sub_titulo' => 'Usuários',--}}
{{--'rota' => 'painel'--}}
{{--])--}}
{{--@includeIf('layouts.admin.componentes.tables',[--}}
{{--'titulos' => $titulos,--}}
{{--'usuarios' => $usuarios,--}}
{{--'rota_edicao' => 'controle_usuarios.edit',--}}
{{--'rota_exclusao' => 'controle_usuarios.destroy',--}}
{{--'nome_botao' => 'Novo',--}}
{{--'titulo' =>'Usuarios'--}}
{{--])--}}
{{--@endsection--}}
{{--@section('modo')--}}
{{--@includeIf('componentes.descricao',[--}}
{{--'descricao_titulo_menu' => 'Modo de Vinculação e Desvinculação',--}}
{{--'nome_titulo_menu' => 'Modo de Vinculação e Desvinculação'--}}
{{--])--}}
{{--@endsection--}}


@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])
    @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'repositorios' => $usuarios,
                    'rota_edicao' => 'controle_usuarios.edit',
                    'rota_exclusao' => 'controle_usuarios.destroy',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Repositórios - Clique no Usuário desejado para editar suas credenciais e vínculos!!',
                    'tipo' => $tipo

    ])
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Usuários',
        'nome_titulo_menu' => 'Usuários'
    ])
@endsection