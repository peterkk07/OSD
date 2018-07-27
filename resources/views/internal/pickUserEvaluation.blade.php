@extends('layouts.internal')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center">Elija el tipo de usuario que desea visualizar</h3>
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/mostrar-rol') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }} ">
                    <label for="rol" class="control-label raleway-semibold">Período lectivo</label>
                    <div class="row">
                        <div class="col-xs-12">
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
                </div>
                <div class="form-group{{ $errors->has('knowledgeArea') ? ' has-error' : '' }} ">
                    <label for="rol" class="control-label raleway-semibold">Área de conocimiento</label>
                    <div class="row">
                        <div class="col-xs-12">
                           <select name="knowledgeArea" id="knowledgeArea"  value="{{ old('subject') }}" size="1" maxlength="1" class="form-control" required="required">
                                 <option value="">Seleccione..</option>
                                     @foreach($knowledgeAreas as $knowledgeArea)
                                <option value="{{$knowledgeArea->name}}">{{$knowledgeArea->name}}</option>
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
                </div>
                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }} ">
                    <label for="rol" class="control-label raleway-semibold">Materia</label>
                    <div class="row">
                        <div class="col-xs-12">
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
                    </div>
                </div>
                <div class="form-group{{ $errors->has('teacher') ? ' has-error' : '' }} ">
                    <label for="rol" class="control-label raleway-semibold">Profesor</label>
                    <div class="row">
                        <div class="col-xs-12">
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
                    </div>
                </div>


                <div class="form-group text-center top-20">
               
                 <button type="button" id="select" name="select" class="btn btn-primary button-form">Aceptar</button>
            
            
                </div>
            </form>
        </div>
    </div>
</div>
@endsection