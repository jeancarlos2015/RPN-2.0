<tr>
    @if(!empty($titulos))
        @foreach($titulos as $titulo1)
            <th>{!! $titulo1 !!}</th>
        @endforeach
    @endif
</tr>