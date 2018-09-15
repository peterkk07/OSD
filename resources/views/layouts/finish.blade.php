<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>OSD</title>

       <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
     <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
   

     <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> 
</head>
<body>

  <div class="row row-finish">

    <div class="col-xs-3">

       <img src="{{asset('img/logos/favico.ico')}}" class="logo-finish-left pull-left img-responsive"/>

    </div>

    <div class="col-xs-3 col-xs-offset-6">

       <img src="{{asset('img/logos/logo-ucv.png')}}" class="logo-finish-right pull-right img-responsive"/>

    </div>


    

  </div>

    @yield('content')

  
    <div class ="foot">
      <p class ="text-center"> ©2018 Facultad de Arquitectura</p>
    </div>
    
  <script src="{{ elixir('js/all.js') }}"></script> 
  <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{!! asset('js/jquerymask.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('js/menu.js') !!}"></script>
</body>
</html>
