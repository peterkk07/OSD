@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3 size-p">
            <h3 class="text-center">Elija alguna de las siguientes opciones para crear la encuesta</h3>

            <p class= "top-40">-Puede crear una encuesta a partir de una que fue generada anteriormente. </p>

            <p>-Puede crear una encuesta nueva. </p>


             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" optione="form" method="POST" action="{{ url('/dashboard/elegir-creacion-encuesta') }}">
                {{ csrf_field() }}

                <div class="top-20 form-group{{ $errors->has('option') ? ' has-error' : '' }} ">
                    <label for="" class="contoption-label raleway-semibold">Elegir opción:</label>
                    <div class="row">
                        <div class="col-xs-12">
                           <select name="option" id="option"  value="{{ old('option') }}" size="1" maxlength="1" class="form-contoption pdd-select" required="required">
                                <option value="edit-survey">Generar una encuesta a partir de una creada anteriormente</option>
                                <option value="new-survey">Generar una nueva encuesta</option>   
                            </select>
                            @if ($errors->has('option'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('option') }}</strong>
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