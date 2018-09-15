@extends('layouts.dashboard')

@section('content')
<div class="container register">
   <div class="row">
      <div class="col-xs-10 col-sm-8 col-md-8 col-xs-offset-1 col-sm-offset-2 size-p">
         <h3 class="text-center">Editar materias</h3>
         @if ($message = Session::get('success'))
            <div class="col-xs-12 alert alert-success">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <p class="message">{{ $message }}</p>
             </div>
         @endif

         <div class="row top-30 size-p">
            <div class="col-xs-12">
               <p>Modifique los campos de las materias que desea editar. </p>
            </div>
         </div>

         <div class="row top-30 size-p">
            <div class="col-xs-4">
               <p class ="text-center">Nombre </p>
            </div>
            <div class="col-xs-4">
               <p class ="text-center">Semestre </p>
            </div>
            <div class="col-xs-4">
               <p class ="text-center">Tipo </p>
            </div>
         </div>

         <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/agregar-materias') }}">
             {{ csrf_field() }}

              {{ Form::hidden('knowledge_area_id', $knowledge_area_id) }}

            @foreach ($subjects as $subject )
            <div class="copy-questions-fields">
               <div class="control-group input-group full-width" style="margin-top:10px">
                  <div class="input-group-btn subject-width"> 
                     <input type="text" name="subject[]" class="form-control" placeholder="Introduza la pregunta" id="copy-text" value="{{$subject->name}} ">
                  </div>

                 {{--  de momento se oculta el codigo de la materia --}}
                  {{-- <div class="input-group-btn subject-width"> 
                     <input type="text" name="subject_code[]" class="form-control" placeholder="Código" id="copy-text" value="{{$subject->cod}}">
                  </div> --}}
                  <div class="input-group-btn subject-width-semester"> 
                     <input type="text" name="semester[]" class="form-control" placeholder="Semestre #" id="copy-text" value="{{$subject->semester}}">
                  </div>
                  <div class="input-group-btn subject-width"> 
                     <select name="subject_type[]" id="copy-text" size="1" maxlength="1" class="form-control" required="required">
                        <option value="{{$subject->type_subject->name}}">{{$subject->type_subject->name}}</option>

                        @foreach($SubjectTypes as $types)
                           @if ($types->name == $subject->type_subject->name)
                              @continue
                           @endif
                           <option value="{{$types->name}}">{{$types->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <input class="hide" type="text" name="subjectId[]" value="{{$subject->id}}">
               </div>

            </div>
            @endforeach
            <div class="input-group control-group after-add-more has-error">
                  @for ($i = 0; $i < 40; $i++)
                     @if($errors->has('subject.' . $i))
                         <span class="help-block">
                             <strong>{{ $errors->first('subject.'. $i) }}</strong>
                         </span>
                          @break
                     @endif
                     @if($errors->has('subject_code.' . $i))
                         <span class="help-block">
                             <strong>{{ $errors->first('subject_code.'. $i) }}</strong>
                         </span>
                          @break
                     @endif
                     @if($errors->has('semester.' . $i))
                        <span class="help-block">
                           <strong>{{ $errors->first('semester.'. $i) }}</strong>
                        </span>
                          @break
                     @endif
                  @endfor

                  {{-- Para agregar nuevas materias, deshabilitar por ahora  --}}
                
                 {{--  <div class="input-group-btn btn-bottom"> 
                     <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
                  </div> --}}
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
               <div class="input-group-btn subject-width"> 
                  <input type="text" name="subject[]" class="form-control" placeholder="Nombre" id="copy-text">
               </div>
               <div class="input-group-btn subject-width"> 
                  <input type="text" name="subject_code[]" class="form-control" placeholder="Código" id="copy-text">
               </div>
               <div class="input-group-btn subject-width"> 
                  <input type="text" name="semester[]" class="form-control" placeholder="Semestre" id="copy-text">
               </div>
               <div class="input-group-btn subject-width"> 
                  <select name="subject_type[]" id="copy-text" size="1" maxlength="1" class="form-control" required="required">
                     <option value="">Tipo</option>
                     @foreach($SubjectTypes as $subject)
                        <option value="{{$subject->name}}">{{$subject->name}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="input-group-btn"> 
                  <button class="btn btn-danger remove subject-remove" type="button"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>
               </div>
             </div>
         </div>
      </div>
   </div> 
</div>
@endsection