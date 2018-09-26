@extends('layouts.dashboard')
@section('content')

      @if ($message = Session::get('error'))
            <div class="col-xs-12 alert alert-error">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p class="message">{{ $message }}</p>
            </div>
      @endif

      <div class="container-fluid">
         
         <div class="row instrucciones-carga">
            <div class="col-xs-12">
               <h2 class= "text-center size-file">Instrucciones </h2>
            </div>
            <div class="col-xs-10 col-md-8 col-xs-offset-1 col-md-offset-2 top-20 loadFile top-30">
               
               <p>-A través de esta opción podrá cargar todos los datos necesarios para el proceso de evaluación de desempeño docente.</p>

               <p>-Debe cargar el archivo de configuración previamente creado en Microsoft Excel bajo el nombre "sample_file", con extension .xlsx o .csv.</p>

               <p>-Una vez seleccionado el archivo de configuración , presione el botónn "cargar", y posteriormente aparecerá un mensaje de confirmación indicando la carga exitosa de los datos.</p>

               <p>-Una vez cargados los datos, puede proceder a dar inicio al Proceso de Evaluación del Desempeño Docente en la opción del menú lateral izquierdo  "Enviar Encuesta".</p>
            </div>

            
               {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
                    <div class="row">
                       <div class="col-xs-10 col-sm-8 col-xs-offset-1 col-sm-offset-2 top-40">
                            <div class="form-group">
                                {!! Form::label('sample_file','Seleccione el archivo de configuración (Formato: .xlsx o .csv):',['class'=>'col-md-4']) !!}
                                <div class="col-md-8">
                                {!! Form::file('sample_file', array('class' => 'form-control')) !!}
                                {!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-xs-offset-2 text-center">
                        {!! Form::submit('Cargar',['class'=>'btn btn-primary top-10']) !!}
                        </div>
                    </div>
               {!! Form::close() !!}
           
         </div>


      </div>

      
   
  

@endsection
