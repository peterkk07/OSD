@extends('layouts.internal')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-md-6 col-xs-offset-1 col-sm-offset-3">
            <h3 class="text-center alert-text">No existen Sub Áreas de Conocimiento asociadas al área que usted coordina.</h3>
             @if ($message = Session::get('success'))
               <div class="col-xs-12 alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p class="message">{{ $message }}</p>
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/mostrar-rol') }}">
                {{ csrf_field() }}
                
                <div class="form-group text-center top-20">
               
                <a href="{{url('/redirectHome')}}">
                    <button type="button" id="select" name="select" class="btn btn-primary button-form">Volver</button>
                </a>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection





























