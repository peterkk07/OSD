@extends('layouts.dashboard')

@section('content')
<div class="container register">
   <div class="row">
      <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
         <h3 class="text-center">Editar preguntas</h3>
          @if ($message = Session::get('success'))
            <div class="col-xs-12 alert alert-success">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <p class="message">{{ $message }}</p>
             </div>
         @endif

         <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/editar-preguntas') }}">
             {{ csrf_field() }}

              {{ Form::hidden('survey_id', $survey_id) }}

            @foreach ($questions as $question )
            <div class="copy-questions-fields">
               <div class="control-group input-group full-width" style="margin-top:10px">
                  <input type="text" name="question[]" class="form-control" placeholder="Introduza la pregunta" id="copy-text" value="{{$question->description}} ">

                  <input class="hide" type="text" name="questionid[]" value="{{$question->id}}">

                  <div class="input-group-btn"> 
                    {{--  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button> --}}
                  </div>
                </div>
            </div>
            @endforeach
            <div class="input-group control-group after-add-more has-error">
                  @for ($i = 0; $i < 40; $i++)
                     @if($errors->has('question.' . $i))
                         <span class="help-block">
                             <strong>{{ $errors->first('question.'. $i) }}</strong>
                         </span>
                          @break
                     @endif
                  @endfor
                  <div class="input-group-btn btn-bottom"> 
                     <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
                  </div>
            </div>
            <div class="form-group text-center top-20">
               <a href= "{{ url('/dashboard/mostrar-encuestas') }}">
                  <button class="btn btn-primary button-form" type="button">Cancelar</button>
               </a>
               <button type="submit" class="btn btn-primary button-form">Aceptar</button>
            </div>
         </form>
         <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
         <div class="copy-fields hide">
            <div class="control-group input-group" style="margin-top:10px">
               <input type="text" name="question[]" class="form-control" placeholder="Introduza la pregunta" id="copy-text">
               <div class="input-group-btn"> 
                  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>
               </div>
             </div>
         </div>
      </div>
   </div> 
</div>
@endsection