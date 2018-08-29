@if(!empty(Auth::user()
       ->github->cod_usuario_github))
    <form action="{!! route('controle_github.destroy',[Auth::user()
        ->github->cod_usuario_github]) !!}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-dark form-control">Apagar Configuração</button>
    </form>
@endif