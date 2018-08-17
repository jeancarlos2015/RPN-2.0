@if(!empty(Auth::user()
       ->github->codusuariogithub))
    <form action="{!! route('controle_github.destroy',[Auth::user()
        ->github->codusuariogithub]) !!}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-dark form-control">Apagar Configuração</button>
    </form>
@endif