@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3 size-p">
            <h3 class="text-center">Crear Encuesta</h3>
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/almacenar-encuesta') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} ">
                    <label for="name" class="control-label raleway-semibold">Nombre de la encuesta</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ejemplo: Encuesta piloto">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <div id="error-msg">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
                    <label for="semester" class="control-label raleway-semibold">Período lectivo</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input id="semester" type="text" class="form-control" name="semester" value="{{ old('semester') }}" placeholder="Ejemplo: 2018-2">
                            @if ($errors->has('semester'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('semester') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                </div>
                <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }} ">
                    <label for="rol" class="control-label raleway-semibold">Estatus</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <select name="status" id="status"  value="{{ old('status') }}" size="1" maxlength="1" class="form-control" required="required">
                                <option value="">Seleccione..</option>  
                                <option value="1">Activa</option>
                                <option value="0">Inactiva</option>
                            </select>
                            @if ($errors->has('status'))
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
                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    <label for="start_date" class="control-label raleway-semibold">Fecha de Inicio</label>
                    <input id="start_date" type="text" class="form-control date" name="start_date" value="{{ old('start_date') }}" autocomplete="off">
                    @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                    <label for="end_date" class="control-label raleway-semibold">Fecha de Finalización</label>
                    <input id="end_date" type="text" class="form-control date" name="end_date" value="{{ old('end_date') }}" autocomplete="off">
                    @if ($errors->has('end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
                 <label for="question[]" class="control-label raleway-semibold">Preguntas</label>
                <div class="input-group control-group after-add-more has-error">

                    @foreach($errors->all() as $key=>$error) 
                        @if($errors->has('question.' . $key ))
                            <span class="help-block">
                                <strong>{{ $errors->first('question.'. $key) }}</strong>
                            </span>
                        @endif
                    @endforeach
                    
                    <input type="text" name="question[]" class="form-control" placeholder="Introduza la pregunta">
                    <div class="input-group-btn btn-bottom"> 
                        <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
                    </div>
                    
                </div>
                <div class="form-group text-center top-20">
                    <a href= "{{ url('/dashboard') }}">
                        <button class="btn btn-primary button-form" type="button">Cancelar</button>
                    </a>
                 <button type="submit" class="btn btn-primary button-form">Crear</button>
               </div>
            </form>
            <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
             <div class="copy-fields hide">
                <div class="control-group input-group" style="margin-top:10px">
                   <input type="text" name="question[]" class="form-control" placeholder="Introduza la pregunta">
                   <div class="input-group-btn"> 
                     <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>
                   </div>
                </div>
             </div>
        </div>
    </div>
      
</div>
@endsection