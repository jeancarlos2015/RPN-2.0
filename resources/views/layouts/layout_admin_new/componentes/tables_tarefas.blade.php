@if(!empty($tarefas))
    <tbody>
    @foreach($tarefas as $tarefa1)
        <tr>
            <td>{!! $tarefa1->codtarefa !!}</td>
            <td>{!! $tarefa1->nome !!}</td>
            <td>{!! $tarefa1->descricao !!}</td>
            <td>

                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $tarefa1->codtarefa, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $tarefa1->codtarefa, 'rota' => $rota_exclusao])
                @endif
                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $tarefa1->codtarefa, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
@endif