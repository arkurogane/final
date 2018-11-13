@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col s12 ">
            <div class="card">
                <div class="card-title center">Datos</div>

                <div class="card-content">
                    @if($save==1)
                        <div class="card-panel green darken-2">Contraseña cambiada con exito!</div>
                    @endif
                    @if($save==2)
                        <div class="card-panel red darken-2">ingrese su contraseña actual!</div>
                    @endif

                    <form method="POST" action="/cambiar">
                            @csrf

                            <div class="form-group row">
                                <div class="col s12">
                                    <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col s12">
                                    <input id="password-confirm" placeholder="{{ __('Confirmar Password') }}" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            
                            <div class="row center">
                                <div class="col s12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
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