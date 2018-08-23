@extends('layouts.home.main')

@section('content')
    <section id="signup" class="signup-section">
        <div class="container">
            <div class="card text-center">
                <div class="card-header dark-text-white">{{ trans('auth.Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">

                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required autofocus
                                   placeholder="Email">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="form-group">


                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" placeholder="Senha" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('auth.Remember_Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">
                                Entrar
                            </button>

                        </div>
                        <div class="form-group">
                            <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                {{ trans('auth.Forgot_Your_Password') }}
                            </a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
