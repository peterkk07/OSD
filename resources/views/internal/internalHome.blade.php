@extends('layouts.internal')

@section('content')

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 top-30 introduction-text">
                <h3 class="text-center">Bienvenido a OSD</h3>
                <p class="top-20">A través del menú lateral izquierdo podrá navegar por las distintas funcionalidades que le ofrece esta aplicación sobre las Áreas y Sub Áreas de Conocimientos, y los profesores que conforman estas mismas, entre las cuales destacan:
                </p>
                <ol>
                    <li>Visualizar Evaluaciones. </li>
                    <li>Visualizar Evaluación Comparativa. </li>
                    <li>Generación de Reportes. </li>
                </ol>

            </div>
        </div>
 		@if ($message = Session::get('success'))
            <div class="col-xs-12 alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="message">{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="col-xs-12 alert alert-error">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="message">{{ $message }}</p>
            </div>
        @endif
        
@endsection