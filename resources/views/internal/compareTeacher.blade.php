@extends('layouts.internal')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-12 size-p">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                     <h3 class="text-center">Elija a un profesor(a) para comparar el resultado de sus evaluaciones con respecto a sus pares en el Área o Sub Área de Conocimiento a la cual pertenece</h3>
                </div>
                
            </div>
           
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/mostrar-rol') }}">
                {{ csrf_field() }}
                
                <div class="row top-40">
                    <p class= "required-field"> * Obligatorio</p>
                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('semester') ? ' has-error' : '' }} ">
                       <label for="rol" class="control-label raleway-semibold">Periodo lectivo</label>
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
                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('knowledgeArea') ? ' has-error' : '' }} ">
                        <label for="rol" class="control-label raleway-semibold">Área de Conocimiento</label>
                        <div id ="selectionArea">
                           <select name="knowledgeArea" id="knowledgeArea"  value="{{ old('knowledgeArea') }}" size="1" maxlength="1" class="form-control" required="required">
                                 <option value="selection">Seleccione..</option>
                                     @foreach($knowledgeAreas as $knowledgeArea)
                                <option value="{{$knowledgeArea->id}}">{{$knowledgeArea->name}}</option>
                                       @endforeach
                            </select>
                            @if ($errors->has('knowledgeArea'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('knowledgeArea') }}</strong>
                                </span>
                            @endif
                            <div id="error-msg">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('subKnowledgeArea') ? ' has-error' : '' }} ">
                       
                         <label for="rol" class="control-label raleway-semibold">Sub Área de Conocimiento</label>
                       <select name="subKnowledgeArea" id="subKnowledgeArea"  value="{{ old('subKnowledgeArea') }}" size="1" maxlength="1" class="form-control" required="required">
                             <option value="selection">Seleccione..</option>
                                 @foreach($subKnowledgeAreas as $subKnowledgeArea)
                            <option value="{{$subKnowledgeArea->id}}">{{$subKnowledgeArea->name}}</option>
                                   @endforeach
                        </select>
                        @if ($errors->has('subKnowledgeArea'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subKnowledgeArea') }}</strong>
                            </span>
                        @endif
                        <div id="error-msg">
                            {!! Session::has('msg') ? Session::get("msg") : '' !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('subject') ? ' has-error' : '' }} ">
                        <label for="rol" class="control-label raleway-semibold">Asignatura</label>
                       <select name="subject" id="subject"  value="{{ old('subject') }}" size="1" maxlength="1" class="form-control" required="required">
                             <option value="">Seleccione..</option>
                                 @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                   @endforeach
                        </select>
                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                        <div id="error-msg">
                            {!! Session::has('msg') ? Session::get("msg") : '' !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('section') ? ' has-error' : '' }} ">
                        <label for="rol" class="control-label raleway-semibold">Sección</label>
                        <select name="section" id="section"  value="{{ old('section') }}" size="1" maxlength="1" class="form-control" required="required">
                             <option value="">Seleccione..</option>
                                 @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                                   @endforeach
                        </select>
                        @if ($errors->has('section'))
                            <span class="help-block">
                                <strong>{{ $errors->first('section') }}</strong>
                            </span>
                        @endif
                        <div id="error-msg">
                            {!! Session::has('msg') ? Session::get("msg") : '' !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 form-group{{ $errors->has('teacher') ? ' has-error' : '' }} ">
                        <label for="rol" class="control-label raleway-semibold">Profesor(a)</label>
                        <select name="teacher" id="teacher"  value="{{ old('teacher') }}" size="1" maxlength="1" class="form-control" required="required">
                             <option value="">Seleccione..</option>
                                 @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                   @endforeach
                        </select>
                        @if ($errors->has('teacher'))
                            <span class="help-block">
                                <strong>{{ $errors->first('teacher') }}</strong>
                            </span>
                        @endif
                        <div id="error-msg">
                            {!! Session::has('msg') ? Session::get("msg") : '' !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9 form-group{{ $errors->has('question') ? ' has-error' : '' }} ">
                        <label for="rol" class="control-label raleway-semibold">Ítem</label> 
                        <select name="question" id="question"  value="{{ old('question') }}" size="1" maxlength="1" class="form-control" required="required">
                           
                        </select>
                        @if ($errors->has('question'))
                            <span class="help-block">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                        @endif
                        <div id="error-msg">
                            {!! Session::has('msg') ? Session::get("msg") : '' !!}
                        </div>
                    </div>



                </div>
                
                <div id="error-chart">
                    <p>Por favor compruebe que ha introducido los datos necesarios (al menos el período lectivo, profesor(a) , asignatura e ítem). </p>

                </div>

                <div id="error-consulta">
                    <p>Este profesor(a) no tiene evaluaciones registradas para la asignatura y sección seleccionada. </p>

                </div>

                <div class="form-group text-center top-20">
               
                 <button type="button" id="select" name="select" class="btn btn-primary button-form">Aceptar</button>

                <a href="{{url('/redirect')}}">
                    <button type="button" id="select" name="select" class="btn btn-primary button-form">Reestablecer valores</button>
                </a>

                </div>
            </form>
        </div>
    </div>

    <div id="count-container" class = "top-30">
        <div id="count-content">
              
        </div>      
    </div>


    <div id="question-container" class = "top-30">
        <div id="question-content">
              
        </div>      
    </div>


    <div class="row top-30">
        <div id="graph-container">
            <canvas id="myChart" width="300" height="200"></canvas>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-4 col-sm-2">
            <div style="overflow-x:auto;">
                <div id="label1" class="label-table top-30"></div>
                <div class="table-container1"></div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-5">
            <div style="overflow-x:auto;">
                <div id="label2" class="label-table background top-30">Cantidad</div>
                <div class="table-container2"></div>
            </div>
        </div>
         <div class="col-xs-4 col-sm-5">
             <div style="overflow-x:auto;">
                <div id="label3" class="label-table background top-30">Porcentaje</div>
                <div class="table-container3"></div>
            </div>
        </div>
    </div>
  
</div>
@endsection

 
@section('scripts')

<script type="text/javascript" src="{!! asset('js/Chart.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/compareChartTeacher.js') !!}"></script>


@endsection





























