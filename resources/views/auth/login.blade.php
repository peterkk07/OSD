@extends('layouts.app')

@section('content')
<div class="login" >
    <div id="customLogin"> 
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                     <img id="logo-login" src="favico.ico" alt="Opine Sobre Docencia Logo">
                </div>
            </div>
           
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <h1>Inicio de Sesión</h1>

               <div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
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
                    <div >
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Recordar usuario
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div >
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-sign-in"></i> Entrar
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

            <div class="clearfix"></div>

                <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> OSD: Opine Sobre Docencia</h1>
                  <p>©2018 Facultad de Arquitectura</p>
                </div>
            </form>
          </section>
        </div>
      </div>
     </div>
      
    </div>
@endsection
