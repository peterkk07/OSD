@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center">Elija el tipo de usuario que desea visualizar</h3>
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/mostrar-rol') }}">
                {{ csrf_field() }}

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
               <div class="form-group text-center top-20">
               
                 <button type="submit" class="btn btn-primary button-form">Aceptar</button>
               </div>
            </form>
        </div>
    </div>
      
</div>
@endsection