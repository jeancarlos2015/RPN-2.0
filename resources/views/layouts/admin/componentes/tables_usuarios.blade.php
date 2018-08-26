@if(!empty($usuarios))
    <tbody>

    @foreach($usuarios as $usuario)
        <tr>
            @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
                <td>
                    @includeIf('layouts.admin.componentes.dado_usuario_administrador_descricao')

                </td>
                {{--Ações--}}
                <td>
                    @includeIf('layouts.admin.componentes.dado_usuario_administrador_rotas')
                </td>
            @elseif(Auth::user()->tipo==='Administrador')
                <td>
                    @includeIf('layouts.admin.componentes.dado_usuario_descricao')
                </td>
                {{--Ações--}}
                <td>
                    @includeIf('layouts.admin.componentes.dado_usuario_rotas')
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
@endif
