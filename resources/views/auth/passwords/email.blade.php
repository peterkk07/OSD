@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="login" >
    <div> 
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
           
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row">
                <div class="col-xs-12">
                     <h2 class="text-center">Introduzca su correo electrónico</h1>
                </div>
            </div>
            
            <form role="form" method="POST" action="{{ url('/password/email') }}">
               
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div >
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-envelope"></i> Enviar correo de recuperación de contraseña
                        </button>
                        <a class="btn btn-link" href="{{ url('/login') }}">Cancelar</a>
                    </div>
                </div>
            </form>
          </section>
        </div>
      </div>
     </div>
</div>
@endsection
