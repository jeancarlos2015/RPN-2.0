
@extends('template_admin.main_home_admin2')

@section('content')

                <div class="form-group">
                    @if(isset($branch))
                        <div class="form-group">Branch Atual:  <strong>{{$branch}} </strong></div>
                    @endif
                    <div class="form-group">Commit De Alterações</div>
                    <div class="form-group">
                        <form method="get" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    @if(isset($result))
                                    <label>Diretório Do Repositório:<br>{{$result}}</label>
                                    @endif
                                    <div class="input-group-addon">Mensagem De Commit</div>
                                    <input type="text" id="msg" name="msg" class="form-control">
                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                </div>
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Commit</button>
                            </div>
                        </form>

                    </div>



                </div>


@endsection