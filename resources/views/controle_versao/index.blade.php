@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Versionamento',
                    'rota' => 'todas_tarefas'
    ])
    <form action="#">
        <button class="btn btn-dark" type="submit">Merge</button>
        <button class="btn btn-dark" type="submit">Commit</button>
        <button class="btn btn-dark" type="submit">Checkout</button>
        <button class="btn btn-dark" type="submit">Create Branch</button>
        <button class="btn btn-dark" type="submit">Delete Branch</button>
        <button class="btn btn-dark" type="submit">Push</button>
        <button class="btn btn-dark" type="submit">Pull</button>
        <br>
        <br>
        @includeIf('layouts.layout_admin_new.componentes.cards')
    </form>

@endsection