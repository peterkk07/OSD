@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3 size-p">
            <h3 class="text-center">Crear Usuarios</h3>
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

           
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/addUser') }}">
                {{ csrf_field() }}

                 <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }} ">
                     <p class= "required-field top-20"> * Obligatorio</p>
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
               <div class="form-group text-center top-20">
                    <a href= "{{ url('/dashboard') }}">
                        <button class="btn btn-primary button-form" type="button">Cancelar</button>
                    </a>
                 <button type="submit" class="btn btn-primary button-form">Crear</button>
               </div>
            </form>
        </div>
    </div>
      
</div>
@endsection