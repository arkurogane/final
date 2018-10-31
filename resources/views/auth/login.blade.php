@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col s12 push-s2-on-med ">
            <div class="card align-content-center">
                <div class="card-title center">{{ __('Login') }}</div>

                <div class="card-content align-content-center">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row center">
                            <div class="push-s1 col s10">
                                <input id="email" placeholder="{{ __('E-Mail') }}" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row center">
                            <div class="push-s1 col s10 ">
                                <input id="password" placeholder="{{ __('Password') }}" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row center">
                            <div class="col s12">
                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        <input class="filled-in" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Recordarme') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn-large blue">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <br>
                            <div class="col s12">
                                <br>
                                <a href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu Contraseña?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s2 hide-on-med-and-down"></div>
    </div>
</div>
@endsection
