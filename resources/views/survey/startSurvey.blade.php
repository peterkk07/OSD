@extends('layouts.dashboard')

@section('content')
<div class="container register">

    <div class="row rules">
        <div class="col-xs-10">
            <h2> Tabla de evaluación:</h2>
            <p>1: Completamente en desacuerdo.</p>
            <p>2: En desacuerdo.</p>
            <p>3: Ni de acuerdo ni en desacuerdo.</p>
            <p>4: De acuerdo.</p> 
            <p>5: Completamente de acuerdo.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center">Por favor responde todas las preguntas correspondientes a la encuesta, para cada profesor elegido</h3>
             @if ($message = Session::get('error'))
               <div class="col-xs-12 alert alert-error">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

          {{--   {{ Form::open(array('action' => 'SurveyController@storeSurvey', "class" => "form-horizontal")) }} --}}

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/guardar-encuesta') }}">
            
                {{ csrf_field() }}

                {{ Form::hidden('id_student', $StudentId) }}
                {{ Form::hidden('survey_id', $Survey_id) }}
                {{ Form::hidden('count_teacher', $CountTeachers) }}
                {{ Form::hidden('cod_token', $cod_token) }}
               
            
                @foreach($Teachers as $key => $Teacher)

                {{ Form::label('teacher', 'Profesor') }}
                {{ Form::text("teacher[]",$Teacher,  array('placeholder' => $Teacher, 'readonly' => 'true')) }}

                    @foreach($questions  as $question) 

                        {{ Form::label('penyakit-0', $question->description) }}

                        <div class="form-group top-30">
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

                                    @foreach($SurveyOptions as $option)

                                    <div class="survey-radio">
                                       
                                       <input type="radio" class="survey-radio" name="option{{$key}}[{{$question->id}}]" value="{{$option->id}}" required>
          
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

                @endforeach


                <div class="form-group text-center top-20">
               
                 <button type="submit" class="btn btn-primary button-form">Aceptar</button>
                </div>


          {{--   {{ Form::close() }} --}}
            </form>
        </div>
    </div>
</div>
@endsection