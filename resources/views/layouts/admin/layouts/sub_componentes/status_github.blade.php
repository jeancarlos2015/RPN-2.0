@if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))

    <li class="nav-item">
        <a class="btn btn-dark" href="{!! route('pull') !!}">Atualizar</a>
    </li>
    @if(Auth::user()->github->branch_atual!=='Nenhum')
        <li class="nav-item">
            <a class="nav-link">
                Ramificação : {{ Auth::user()->github->branch_atual }} <span class="sr-only"></span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link">
                Base: {{ Auth::user()->github->repositorio_atual }} <span class="sr-only"></span>
            </a>
        </li>
    @endif
@endif