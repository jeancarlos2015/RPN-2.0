@if(!empty($repositorios))
    <tbody>

    @foreach($repositorios as $repositorio)
        <tr>
            <td>{!! $repositorio['name'] !!}</td>
            <td>{!! $repositorio['full_name'] !!}</td>
            <td>
                <div class="form-group">
                    <a href="{!!$repositorio["html_url"] !!}"><img src="{!! asset('img/olho.png') !!} "
                                                                   style="width: 20px" title="Visualizar"></a>
                </div>
                <div class="form-group">
                    <a href="{!!route('selecionar_repositorio',[
                'repositorio_atual' => $repositorio['name'],
                'default_branch' => $repositorio['default_branch']

                ]) !!}"
                       style="display: inline-block">
                        <input type="image" src="{!! asset('img/select.png') !!}" alt="Submit" width="20"
                               title="Selecionar">
                    </a>
                </div>
                @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
                    <div class="form-group">
                        <a href="{!!route('delete_repository',[
                'repositorio_atual' => $repositorio['name'],
                'default_branch' => $repositorio['default_branch']

                ]) !!}"
                           style="display: inline-block">
                            <input type="image" src="{!! asset('img/delete.png') !!}" alt="Submit" width="20"
                                   title="Remover Base/Repositório">
                        </a>
                    </div>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
@endif
