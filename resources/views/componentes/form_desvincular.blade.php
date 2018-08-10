<form action="{!! route('controle_usuarios.update',[$id]) !!}" method="post">
    @csrf
    {{ method_field('PUT')}}
    <input type="hidden" name="desvincular" value="true">
    <input type="image" src="{!! asset('img/turn-off.png') !!}" alt="Submit" width="20" title="Desvincular">
</form>

