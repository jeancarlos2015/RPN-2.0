
@extends('template_admin.main_home_admin2')

@section('content')
                <div class="form-group">

                        {{--<p>Crição De Branch</p>--}}
                        <form method="get" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Criar Branch</div>
                                    <input type="text" id="branch" name="branch" class="form-control">
                                    <button type="submit" class="btn btn-primary btn-sm col-4">Criar Branch</button>
                                </div>

                            </div>
                        </form>

                        <form method="get" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Remover Branch</div>

                                    <select id="branch" name="branch" class="form-control">
                                        <option></option>

                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm col-4">Remover Branch</button>
                                </div>
                            </div>

                        </form>




                </div>

@endsection