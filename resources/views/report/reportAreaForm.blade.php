@extends('layouts.internal')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 size-p">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <h3 class="text-center">Elija el Área de Conocimiento para la cual desea generar un reporte</h3>
                </div>
            </div>
            @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

            <form class="top-20 form-horizontal" role="form" method="POST" action="{{ url('/reporte-area') }}">
                {{ csrf_field() }}
                
            <div class="row">
                 <p class= "required-field"> * Obligatorio</p>
               <div class="col-xs-12 col-sm-4 form-group{{ $errors->has('semester') ? ' has-error' : '' }} ">
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
                <div class="col-xs-12 col-sm-4 form-group{{ $errors->has('knowledgeArea') ? ' has-error' : '' }} ">
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
            </div>
                <div class="form-group text-center top-20">
                
                 @if ($message = Session::get('error'))
                    <div class="col-xs-12 alert alert-error">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p class="message">{{ $message }}</p>
                    </div>
                @endif
                 <button type="submit" id="select" name="select" class="btn btn-primary button-form">Generar Reporte</button>

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
<script type="text/javascript" src="{!! asset('js/reporter/displayReporterArea.js') !!}"></script>

@endsection





























