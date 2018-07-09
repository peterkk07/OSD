@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center">Por favor elige únicamente 2 profesores para evaluar</h3>
             @if ($message = Session::get('error'))
               <div class="col-xs-12 alert alert-error">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/empezar-encuesta') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="teachers" class="control-label raleway-semibold">Rol</label>
                    <div class="row">
                        <div class="col-xs-12">
                            
                            {{ Form::hidden('id_student', $StudentId) }}

                            {{ Form::hidden('cod_token', $cod_token) }}
                
                            @foreach($Teachers as $Teacher)

                                <input type="checkbox" name="teachers[]" value="{{$Teacher->id}}">{{$Teacher->name}}<br>
                                
                            @endforeach

                            <div id="error-msg">
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center top-20">
               
                 <button type="submit" class="btn btn-primary button-form">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection