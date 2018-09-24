@extends('layouts.dashboard')

@section('content')

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

        <div class="row">
            <div class="col-xs-10 col-md-8 col-xs-offset-1 col-md-offset-2 top-20 loadFile top-30">
                <h3 class="text-center"> BIENVENIDO A OSD </h3>
               
               <p class ="top-50">A través del menú lateral izquierdo podrá navegar por las distintas opciones de la aplicación , entre las cuales destacan:</p>

               <p><b>Carga Masiva de Datos:</b> A través de esta opción se podrán cargar los datos necesarios para el funcionamiento de esta aplicación a través de un archivo de configuración en formato .xlsx o .csv  </p>

               <p><b>Administrar Usuarios: </b> Opción para crear , visualizar, editar y eliminar usuarios.</p>

               <p><b>Administrar Encuestas: </b> Se podrá crear, configurar y visualizar encuestas, para enviarlas a los estudiantes posteriormente e iniciar el proceso de evaluación docente.</p>

               <p><b>Administrar Áreas de Conocimiento: </b> Opción para visualizar, editar y eliminar Áreas de Conocimiento.</p>

               <p><b>Administrar Sub Áreas de Conocimiento: </b> Permite visualizar, editar y eliminar Sub Áreas de Conocimiento.</p>

            </div>
        </div>
        
@endsection