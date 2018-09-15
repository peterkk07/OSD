@extends('layouts.internal')

@section('content')

<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-xs-offset-1 col-sm-offset-3 size-p">
            <h3 class="text-center">Por favor elige el profesor a evaluar. Puedes evaluar hasta un máximo de 2 profesores.</h3>
             @if ($message = Session::get('error'))
               <div class="col-xs-12 alert alert-error">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif

            <form class="form-horizontal top-50" role="form" method="POST" action="{{ url('/dashboard/empezar-encuesta') }}">
                {{ csrf_field() }}

                <div class="form-group">
                   
                    <div class="row">
                        <div class="col-xs-12 teachers-form">
                            
                            {{ Form::hidden('id_student', $StudentId) }}

                            {{ Form::hidden('cod_token', $cod_token) }}
                
                            @foreach($Teachers as $key =>$Teacher)

                                <input type="radio" name="teachers[]" value="{{$Teacher->id}}">{{$Teacher->name}} ({{$Subjects[$key]->name}}).<br>
                            @endforeach

                            <div id="error-msg">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center top-20">
                    <button type="submit" class="btn btn-primary button-form">Aceptar</button>
                    
                    @if ($count_evaluation>0)
                   
                    <button type = "button" class="btn btn-primary button-form" onclick="location.href='{{ url('/dashboard/finalizar-encuesta/'.$cod_token.'/'.$StudentId) }}'">Finalizar proceso</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('link')
<a href="/dashboard/llenar-encuesta/{{$cod_token}}/{{$StudentId}}">
    <i class="fa fa-file-text-o"></i>
    Elegir profesores a evaluar.
</a>
@endsection