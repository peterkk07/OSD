@extends('layouts.dashboard')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3 size-p">
            <h3 class="text-center">¿Desea eliminar  el Área de Conocimiento seleccionada definitivamente ?  </h3>
               {{--  <p class= "text-center">{{$user->name}}</p> --}}
         
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/confirmar-eliminacion-area') }}">
                {{ csrf_field() }}
                
                {{ Form::hidden('id', $area_id) }}
               <div class="form-group text-center top-20">
                    <a href= "{{ url('/dashboard/ver-areas') }}">
                        <button class="btn btn-primary button-form" type="button">Cancelar</button>
                    </a>
                    <button type="submit" class="btn btn-primary button-form">Aceptar</button>
               </div>
            </form>
        </div>
    </div>
      
</div>
@endsection