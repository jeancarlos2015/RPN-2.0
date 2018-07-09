
    <form action="{!!route($rota,[$id]) !!}" method="post"
          style="display: inline-block">
        {!! csrf_field() !!}
        {{ method_field('DELETE')}}
        <input type="image" src="{!! asset('img/delete.png') !!}" alt="Submit" width="20" title="Remover">
    </form>
