@extends('layouts.dashboard')
@section('content')
<div class="container register">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 size-p">
            <h3 class="text-center">Creación de encuesta a partir de una generada anteriormente</h3>
            <p class="text-center">
                Introduzca los datos necesarios para la configuración de la encuesta
            </p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/crear-encuesta-editada') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="semester" class="control-label raleway-semibold">Período lectivo</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input id="semester" type="text" class="form-control" name="semester" value="{{ $semesters->name }}">
                            @if ($errors->has('semester'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('semester') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                </div>
                
                @foreach($semesters->survey as $semester)
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label raleway-semibold">Nombre</label>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $semester->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                </div>
             
                @endforeach

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
                
                
                {{ Form::hidden('id_semester', $semesters->id) }}
                {{ Form::hidden('id_survey', $survey_id) }}

                <div class="form-group row buttons">
                    <div class="col-xs-12 text-center">
                        <a href= "{{ url('/dashboard/mostrar-encuestas') }}">
                            <button class="btn btn-primary button-form" type="button">Cancelar</button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-register button-form">
                            <i class="fa fa-btn fa-user"></i> Siguiente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection