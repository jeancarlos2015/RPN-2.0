<form onsubmit="return confirm('Deseja Desvincular Este Usuário?');" action="{!! route('desvincular_usuario_repositorio') !!}" method="post">
    @csrf
    @method('POST')
    <input type="hidden" name="desvincular" value="true">
    <input type="hidden" name="codusuario" value="{!! $id !!}">
    <input type="image" class="confirm" src="{!! asset('img/turn-off.png') !!}" alt="Submit" width="20"
           title="Desvincular">

</form>