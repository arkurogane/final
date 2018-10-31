@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col s10 push-s1">
            <div class="card">
                <div class="card-title center">{{ __('Modificar') }}</div>

                <div class="card-content">
                    <form method="POST" action="/actualizar/{{$user->id}}">
                        @csrf

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                            <input id="name" placeholder="{{ __('Nombre') }}" type="text" value="{{$user->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="apellido" placeholder="{{ __('Apellido') }}" value="{{$user->apellido}}" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required>

                                @if ($errors->has('apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="email" placeholder="{{ __('E-Mail') }}" type="email" value="{{$user->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
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
