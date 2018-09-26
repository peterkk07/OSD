@extends('layouts.app')

@section('content')

      <div class="row top-50">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
          <form class="form-horizontal form-box" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <h1 class="text-center top-30 login-text">Inicio de Sesión</h1>

           <div class="top-30 form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
                <div >
                    <input id="ci" type="ci" class="form-control" name="ci" placeholder="Cédula">

                    @if ($errors->has('ci'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ci') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div >
                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
              <div>
                <button type="submit" class="btn btn-default pull-left">
                    <i class="fa fa-btn fa-sign-in"></i> Ingresar
                </button>
               
                <a class="btn btn-link pull-right reset-pass" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
               
              </div>
            </div>

            <div class="clearfix"></div>

            {{-- <div>
              <h1 class="text-center top-30 osd-text"><i class="fa fa-file-text-o"></i> OSD: Opine Sobre Docencia</h1>
            </div> --}}
          </form>
        </div>
      </div>
        
        
@endsection
