@extends('layouts.dashboard')
@section('content')
<div class="container register">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <h3 class="text-center">Editar Usuario</h3>
            <p class="text-center">
                Introduzca los datos del usuario que desea editar
            </p>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/editar-usuario') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label raleway-semibold">Nombre</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                </div>
                <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                    <label for="ci" class="control-label raleway-semibold">Cédula</label>
                    <input id="ci" type="text" class="form-control" name="ci" value="{{ $user->ci }}">
                    @if ($errors->has('ci'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ci') }}</strong>
                        </span>
                    @endif
                </div>

                {{-- Si el usuario tiene rol estudiante,  no necesita cambio de contraseña --}}
                @unless($user->type_user->description == "Estudiante")
               
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label raleway-semibold">Nueva Contraseña</label>
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

                 @endunless

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label raleway-semibold">Correo</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

            {{-- Si el usuario tiene rol estudiante,  no necesita cambio de tipo  usuario --}}
                @unless($user->type_user->description == "Estudiante")


                <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }} ">
                    <label for="rol" class="control-label raleway-semibold">Rol</label>
                    <div class="row">
                        <div class="col-xs-12">
                           <select name="rol" id="rol"  value="{{ old('rol') }}" size="1" maxlength="1" class="form-control" required="required">
                                 <option value="">Seleccione..</option>
                                     @foreach($roles as $role)
                                <option value="{{$role->description}}">{{$role->description}}</option>
                                       @endforeach
                            </select>
                            @if ($errors->has('rol'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rol') }}</strong>
                                </span>
                            @endif
                            <div id="error-msg">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                    </div>
                </div>

                 @endunless

                {{ Form::hidden('id', $user->id) }}

                <div class="form-group row buttons">
                    <div class="col-xs-12 text-center">
                        <a href= "{{ url('/dashboard/mostrar-rol') }}">
                            <button class="btn btn-primary button-form" type="button">Cancelar</button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-register button-form">
                            <i class="fa fa-btn fa-user"></i> Guardar
                        </button>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>
</div>
@endsection