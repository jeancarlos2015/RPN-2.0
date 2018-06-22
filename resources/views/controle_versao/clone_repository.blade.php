
@extends('template_admin.main_home_admin2')

@section('content')

    <div class="animated fadeIn">
        <div class="row">

            <div class="col-lg-6">
                @if(isset($branch))
                    <div class="card-header">Branch Atual:  <strong>{{$branch}} </strong></div>
                @endif
                <div class="card">
                    <div class="card-header">Clonar Repositório</div>
                    <div class="card-body card-block">
                        <form action="#" method="get" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">URL GIT</div>
                                    <input type="text" id="url_git" name="url_git" class="form-control">
                                    <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Clonar Repositório</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->

@endsection