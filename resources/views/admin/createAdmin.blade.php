@extends('layouts.general')
@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center">REGISTRAR USUARIO ADMINISTRADOR</h3>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/almacenarAdmin') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }} ">
                    <label for="ci" class="control-label raleway-semibold">Cédula de Identidad</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input id="ci" type="text" class="form-control" name="ci" value="{{ old('ci') }}">
                            @if ($errors->has('ci'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ci') }}</strong>
                                </span>
                            @endif
                            <div id="error-msg">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label raleway-semibold">Nombre</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label raleway-semibold">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="control-label raleway-semibold">Confirmar Contraseña</label>  
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label raleway-semibold">Correo</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group row buttons">
                    <div class="col-xs-6 col-md-4 col-md-offset-2">
                        <button type="submit" class="btn btn-primary btn-register button-form">
                            <i class="fa fa-btn fa-user"></i> Crear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
      @if ($message = Session::get('success'))
        <div class="col-xs-12 alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p class="message">{{ $message }}</p>
        </div>
        @endif
</div>
@endsection