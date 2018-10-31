@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col s8 push-s2">
            <div class="card">
                <div class="card-title center">Datos</div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/cambiar/{{ $user->id }}">
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