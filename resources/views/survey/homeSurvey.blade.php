@extends('layouts.student')

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 size-p">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-center alert-text top-10">Bienvenido a "Opine Sobre Docencia", un sistema diseñado para la evaluación del desempeño docente de los profesores de la Escuela de Arquitectura y Urbanismo de la UCV.</h3>
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

            <p class= "top-30"> Puedes realizar el proceso de evaluación docente a través de una serie de sencillos pasos, los  cuales se muestran a continuación:</p>

            <ol class= "top-30 instructions">
                <li>Selecciona la primera opción del menú lateral izquierdo "Elegir profesores a evaluar".  </li>
                <li>Se mostrará un listado de profesores, los cuales dictan las asignaturas inscritas por ti en el actual periodo lectivo.</li>
                <li>De este listado, tienes la posibilidad de elegir 1 o 2 profesores para realizar su evaluación a través de un formulario que se desplegará luego de seleccionar al  docente y hacer click en el botón "Aceptar".</li>
                <li>Una vez realizada la encuesta, debes seleccionar el botón "Guardar respuestas".</li>
                <li>Al resolver la primera encuesta podŕas elegir a un segundo profesor a evaluar, o finalizar el proceso si así lo deseas.</li>
            </ol>
            
        </div>
    </div>
</div>
@endsection



@section('link')

<a href="http://ve.wktapp.com/api/OSD/public/dashboard/llenar-encuesta/{{$cod_token}}/{{$StudentId}}">
    <i class="fa fa-file-text-o"></i>
    Elegir profesores a evaluar.
</a>

@endsection

                          

