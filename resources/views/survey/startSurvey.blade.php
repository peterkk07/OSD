@extends('layouts.student')

@section('content')
<div class="container register">

    <div class="row top-100 rules">
        <div class="col-xs-12">
            <h2> Escala de evaluación:</h2>
            <p>1: Completamente en desacuerdo.</p>
            <p>2: En desacuerdo.</p>
            <p>3: Medianamente de acuerdo.</p>
            <p>4: De acuerdo.</p> 
            <p>5: Completamente de acuerdo.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3 size-p">
            <p class="text-center top-30 question-p">A continuación se presenta una serie de ítems relacionados con el desempeño docente. Responde según sea tu nivel de acuerdo o desacuerdo con cada uno de ellos, considerando la escala de evaluación ubicada en la esquina superior izquierda del formulario.</p>
             @if ($message = Session::get('error'))
               <div class="col-xs-12 alert alert-error">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

        
          {{--   {{ Form::open(array('action' => 'SurveyController@storeSurvey', "class" => "form-horizontal")) }} --}}

            <form class="form-horizontal top-40" role="form" method="POST" action="{{ url('/dashboard/guardar-encuesta') }}">
            
                {{ csrf_field() }}

                {{ Form::hidden('id_student', $StudentId) }}
                {{ Form::hidden('survey_id', $Survey_id) }}
               {{--  {{ Form::hidden('count_teacher', $CountTeachers) }} --}}
                {{ Form::hidden('cod_token', $cod_token) }}
                {{ Form::hidden('teacher_id', $teacher_id) }}
               
            
                {{-- @foreach($Teachers as $key => $Teacher) --}}

                {{ Form::label('teacher', 'Profesor(a):',['class' => 'question-survey']) }}
                <span class=" top-20 teacher-question">{{$Teachers}}.</span>
               {{--  {{ Form::text("teacher[]",$Teacher,  array('placeholder' => $Teacher, 'readonly' => 'true')) }} --}}

                    @foreach($questions  as $key => $question) 
                        
                       <?php $index = $key+1 ?>

                    
                        {{ Form::label('penyakit-0', $index.') '. $question->description,['class' => 'top-30 question-survey']) }}

                        <div class="form-group">
                          {{--   <label for="teachers" class="control-label raleway-semibold">Rol</label> --}}
                            <div class="row">
                                <div class="col-xs-12 flex-item">
                                
                                @foreach($errors->all() as $key=>$error) 
                                    @if($errors->has('option.' . $key ))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('option.'. $key) }}</strong>
                                        </span>
                                    @endif
                                @endforeach

                                    @foreach($SurveyOptions as $key => $option)

                                    <div class="survey-radio">
                                       
                                       <input title="{{$Scale[$key]}}" type="radio" class="survey-radio" name="option[{{$question->id}}]" value="{{$option->id}}" required>
          
                                        {{ Form::label('penyakit-0', $option->id ) }}
        
                                    </div>
                                    @endforeach
                                    <div id="error-msg">
                                        {!! Session::has('msg') ? Session::get("msg") : '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

               {{--  @endforeach --}}


                <div class="form-group text-center top-20">
               
                 <button type="submit" class="btn btn-primary button-form">Guardar respuestas</button>
                </div>


          {{--   {{ Form::close() }} --}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('link')
<a href="http://ve.wktapp.com/api/OSD/public/dashboard/llenar-encuesta/{{$cod_token}}/{{$StudentId}}">
    <i class="fa fa-file-text-o"></i>
    Elegir profesores a evaluar.
</a>
@endsection