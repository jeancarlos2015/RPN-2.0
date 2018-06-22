
@extends('template_admin.main_home_admin2')

@section('content')


            <div class="form-group">
                <div class="form-group">
                    <div class="form-group">Inicialização De Repositório</div>
                    <div class="form-group">
                        <form  method="post">
                            <div class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-addon">Diretório</div>
                                     <input type="text" id="msg" name="msg" class="form-control">
                                 </div>
                            </div>
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Inicializar Repositório</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



@endsection