@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">{{ __('Register') }}</div>

                <div class="card-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="name" placeholder="{{ __('Nombre') }}" type="text" class="input-field validate{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="apellido" placeholder="{{ __('Apellido') }}" type="text" class="validate {{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required>

                                @if ($errors->has('apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="rut" type="text" placeholder="{{ __('Rut') }}" oninput="checkRut(this)" class="validate {{ $errors->has('rut') ? ' is-invalid' : '' }}" name="rut" value="{{ old('rut') }}" required>

                                @if ($errors->has('rut'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rut') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="email" placeholder="{{ __('E-Mail') }}" type="email" class="validate{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="password-confirm" placeholder="{{ __('Confirmar Password') }}" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn-large blue">
                                    {{ __('Register') }}
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
