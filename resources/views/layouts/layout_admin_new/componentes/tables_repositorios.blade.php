@if(!empty($repositorios))
    <tbody>
    @foreach($repositorios as $organizacao1)
        <tr>
            {{--<td>{!! $organizacao1->codrepositorio !!}</td>--}}
            {{--<td>{!! $organizacao1->nome !!}</td>--}}
            {{--<td>{!! $organizacao1->descricao !!}</td>--}}
            <td>
                <div class="media">
                    <div class="media-body">
                        <strong>{!!  $organizacao1->nome !!}</strong>
                        <div class="text-muted smaller">Código da Organização: {!! $organizacao1->codrepositorio !!}</div>
                        <div class="text-muted smaller">Participações: {!! count($organizacao1->usuarios) !!}</div>
                        <div class="text-muted smaller">Descrição da Organização: {!! $organizacao1->descricao !!}</div>
                    </div>
                </div>
            </td>
            <td>
                @if(Auth::user()->email==='jeancarlospenas25@gmail.com')

                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $organizacao1->codrepositorio, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $organizacao1->codrepositorio, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $organizacao1->codrepositorio, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
@endif