@extends('layouts.home.main')
@section('content')

    <!-- Signup Section -->
    <section id="signup" class="signup-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-center">

                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Busca de Modelos BPMN</h2>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Busca por Nome..">
                </div>
            </div>
            <div class="row">
                @php
                    $contador = 0;
                @endphp

                <ul id="myUL" class="float">

                    @foreach($modelos as $modelo1)
                        <li class="float-item">
                            <div class="card card-body text-left">
                                <a href="{!! route('visualizar_modelo_publico',[$modelo1->codmodelodiagramatico]) !!}">
                                    <div class="media">
                                        <img class="d-flex mr-3 rounded-circle"
                                             src="{{ Gravatar::src($modelo1->usuario->email) }}"
                                             alt="" width="60">
                                        <div class="media-body">
                                            <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                                            <div class="text-muted smaller">
                                                Responsável: {!! $modelo1->usuario->name !!}</div>
                                            <div class="text-muted smaller">Descrição do
                                                Modelo: {!! $modelo1->descricao !!}</div>
                                            <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
                                            <div class="text-muted smaller">
                                                Projeto: {!! $modelo1->projeto->nome !!}</div>
                                            <div class="text-muted smaller">
                                                Repositório: {!! $modelo1->repositorio->nome !!}</div>

                                            <div class="text-muted smaller">
                                                Data da Criação: {!! $modelo1->created_at !!}</div>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                        @if($contador>3)
                            @break
                        @endif
                        @php
                            $contador++
                        @endphp
                    @endforeach

                </ul>


            </div>
        </div>
    </section>
@endsection


@section('codigo_css')
    <style>
        #myInput {
            background-image: url('/css/searchicon.png'); /* Add a search icon to input */
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

        #myUL {
            /* Remove default list styling */
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd; /* Add a border to all links */
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6; /* Grey background color */
            padding: 12px; /* Add some padding */
            text-decoration: none; /* Remove default text underline */
            font-size: 18px; /* Increase the font-size */
            color: black; /* Add a black text color */
            display: block; /* Make it into a block element to fill the whole list */
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee; /* Add a hover effect to all links, except for headers */
        }

        /*------------------------------------manipula a listagem---------------------------------*/
        .float {
            max-width: 1200px;
            margin: 0 auto;
        }

        .float:after {
            content: ".";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        .float-item {
            float: left;
            margin-left: 2%;
            margin-top: 2%;
        }

    </style>

@endsection


@section('codigo_js')
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, ul, li, a, i;
            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName('li');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
@endsection