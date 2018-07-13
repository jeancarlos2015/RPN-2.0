@if(!empty($regras))
    <tbody>
    @foreach($regras as $regra1)
        {{--{!! dd($regra1->tarefa2->nome) !!}--}}
        <tr>
            <td>{!! $regra1->codregra !!}</td>
            <td>{!! $regra1->tarefa1->nome !!}</td>
            <td>{!! $regra1->operador !!}</td>
            <td>{!! $regra1->tarefa2->nome !!}</td>

            <td>

                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $regra1->codregra, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $regra1->codregra, 'rota' => $rota_exclusao])
                @endif
                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $regra1->codregra, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
@endif