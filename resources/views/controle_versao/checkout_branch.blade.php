
@extends('template_admin.main_home_admin2')

@section('content')


            <div class="form-group">
                @if(isset($branch))
                    <div class="form-group">Branch Atual:  <strong>{{$branch}} </strong></div>
                @endif
                <div class="form-group">
                    <div class="form-group">
                        <form action="#" method="get" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="form-control-label" for="ar">Branch</label>
                                    <select id="branch" name="branch" class="form-control" style="width: 100%;">
                                        <option></option>
                                        @if(!empty($branchs))
                                            @foreach($branchs as $branch1)
                                                <option value="{!! $branch1 !!}" @if(!empty($branch1) and $branch1 != $branch) selected @endif>{!! $branch1 !!}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Chekout Branch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


@endsection