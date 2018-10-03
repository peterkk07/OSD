@extends('layouts.internal')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-12 size-p">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                     <h3 class="text-center">Elija el periodo lectivo, asignatura y sección para generar el reporte de su evaluación de desempeño docente.
                    </h3>
                </div>
                
            </div>
           
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/reporte-profesor') }}">
                {{ csrf_field() }}
                
                {{ Form::hidden('teacher_id', $teacherId) }}

                <div class="row top-50">
                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('semester') ? ' has-error' : '' }} ">
                       <label for="rol" class="control-label raleway-semibold">Período lectivo</label>
                       <select name="semester" id="semester"  value="{{ old('semester') }}" size="1" maxlength="1" class="form-control" required="required">
                            <option value="">Seleccione..</option>
                                 @foreach($semesters as $semester)
                            <option value="{{$semester->id}}">{{$semester->name}}</option>
                                   @endforeach
                        </select>
                        @if ($errors->has('semester'))
                            <span class="help-block">
                                <strong>{{ $errors->first('semester') }}</strong>
                            </span>
                        @endif
                        <div id="error-msg">
                            {!! Session::has('msg') ? Session::get("msg") : '' !!}
                        </div>
                    </div>
                   
                </div>
                <div class="form-group text-center top-20">
        
                <button type="submit" id="select" name="select" class="btn btn-primary button-form">Generar Reporte </button>

                <a href="{{url('/redirect')}}">
                    <button type="button" id="select" name="select" class="btn btn-primary button-form">Reestablecer valores</button>
                </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

 
@section('scripts')

<script type="text/javascript" src="{!! asset('js/Chart.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/reporter/displayReporterTeacher.js') !!}"></script>

@endsection





























