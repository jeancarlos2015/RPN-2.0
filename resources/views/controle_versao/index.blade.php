@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}
    <h3>Controle De Versão</h3>
    <br>
    <h3>Inicialização de repositório</h3>
    <a class="btn btn-primary form-control" href="{!! route('init') !!}">Inicializar Repositório</a>
    <br>
    <br>
    <h3>Crição de Branch</h3>
    <br>
    <form action="{!! route('create') !!}" method="post">
        {!! csrf_field() !!}
        <label>Nome </label>
        <br>
        <input type="text" name="nome_branch" class="form-control">
        <br>
        <br>
        <input type="submit" value="Criar Branch" class="btn btn-primary form-control">
    </form>
    <br>
    <h3>Listagem das branchs</h3>
    <br>
    @if(!empty($branchs))
        <ul>
            @foreach($branchs as $branch)
                <li>{!! $branch !!}</li>
            @endforeach
        </ul>
    @endif

    <h3>Commit das alterações</h3>
    <br>
    @if(!empty($branch_atual))
        <h4>Branch Atual: {!! $branch_atual !!}</h4>
    @endif
    <br>
    <form action="{!! route('commit') !!}" method="post">
        {!! csrf_field() !!}
        <label>Mensagem </label>
        <br>
        <input type="text" name="mensagem" class="form-control">
        <br>
        <br>
        <input type="submit" value="Efetuar Commit" class="btn btn-primary form-control">
    </form>
    <br>
    <h3>Checkou Branch</h3>

    <form action="{!! route('checkout') !!}" method="post">
        {!! csrf_field() !!}
        <label >Branch Atual </label>
        <select name="branch" class="form-control">
            @if(!empty($branchs))
                @foreach($branchs as $branch)
                    <option>{!! $branch !!}</option>
                @endforeach
            @endif
        </select>
        <input type="submit" value="Checkout" class="btn btn-primary form-control">
    </form>

    <br>
    <br>
    <h3>Merge Branch</h3>

    <form action="{!! route('merge') !!}" method="post">
        {!! csrf_field() !!}
        <label >Branch Atual </label>
        <select name="branch" class="form-control">
            @if(!empty($branchs))
                @foreach($branchs as $branch)
                    <option>{!! $branch !!}</option>
                @endforeach
            @endif
        </select>
        <input type="submit" value="merge" class="btn btn-primary form-control">
    </form>

    <h3>Delete Branch</h3>

    <form action="{!! route('delete') !!}" method="post">
        {!! csrf_field() !!}
        <label >Branch Atual </label>
        <select name="branch" class="form-control">
            @if(!empty($branchs))
                @foreach($branchs as $branch)
                    <option>{!! $branch !!}</option>
                @endforeach
            @endif
        </select>
        <input type="submit" value="delete" class="btn btn-primary form-control">
    </form>


@endsection