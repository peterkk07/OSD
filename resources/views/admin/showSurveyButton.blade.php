@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row size-p">
        <div class="col-xs-10 col-sm-8 col-xs-offset-1 col-sm-offset-2">
            <h3 class="text-center"> ¿ Desea Inicializar la encuesta: "{{$Survey}}" Corresponiente al período lectivo {{$Semester}}  ? </h3>

            <p class ="top-30">Al hacer click en el botón "Aceptar", será enviado un correo electrónico a cada estudiante del período lectivo actual con una invitación para participar en el proceso de evaluación docente. </p>
             
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/enviar-encuesta') }}">
                {{ csrf_field() }}
               <div class="form-group text-center top-20">
                    <a href= "{{ url('/dashboard') }}">
                        <button class="btn btn-primary button-form" type="button">Cancelar</button>
                    </a>
                    <button type="submit" class="btn btn-primary button-form">Aceptar</button>
               </div>
            </form>
        </div>
    </div>
      
</div>
@endsection