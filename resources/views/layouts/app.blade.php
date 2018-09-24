<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>@yield('title')</title>

       <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
   

     <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
  
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
</head>
<body>

  
  <div class="row hidden-xs color-login">
      <div class="col-xs-12 col-md-10 col-md-offset-1">
         <div class="row">
            <div class="col-xs-2 logo-ucv-home">
               <img src="{{asset('img/logos/logo-ucv.png')}}" class="img-responsive" />
            </div>
            <div class="col-xs-8 text-center top-20 mg-0">
                <img id="logo-login" class="img-responsive" src="{{asset('img/logos/favico.ico')}}" alt="Opine Sobre Docencia Logo">
               <h3 class = "top-20 color-title-login">Programa de Evaluación del Desempeño Docente de la Facultad de Arquitectura y Urbanismo de la UCV </h3>
            </div>
            <div class="col-xs-2 fau-logo">
               <img src="{{asset('img/logos/FAU-UCV-WHITE.png')}}" class="img-responsive" />
            </div>
         </div>
      </div>
   </div>
   <div class="row hidden-sm hidden-md hidden-lg color-login">
      <div class="col-xs-12">
         <div class="row">
            <div class="col-xs-12 text-center top-20 mg-0">
                <img id="logo-login" class="img-responsive" src="favico.ico" alt="Opine Sobre Docencia Logo">
               <h3 class = "top-20 color-title-login">Programa de Evaluación del Desempeño Docente de la Escuela de Arquitectura de la UCV </h3>
            </div>
         </div>
      </div>
   </div>


    @yield('content')


    
  
      <div id="footer">
          <p>© OSD 2018 -UCV- Facultad de Arquitectura y Urbanismo</p>
      </div>

  <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{!! asset('js/dinamic-footer.js') !!}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

   
</body>
</html>
