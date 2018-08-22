@extends('mails.layouts.template_basico.layout)

@section('content')

    <p style="line-height: 24px; margin-bottom:15px;">

        Primeiramente,

    </p>
    <p style="line-height: 24px;margin-bottom:15px;">
        Você foi desvinculado do repositório {!! $repositorio->nome !!} pelo administrador {!! Auth::user()->name !!}, responsável por criar os repositórios usados pelos usuarios.
        pelos Usuários.
    </p>
    <p style="line-height: 24px; margin-bottom:20px;">
        Você pode acessar o sistema através do link abaixo:
    </p>
@endsection