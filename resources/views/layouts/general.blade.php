<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
       <!-- Favicon --> 


</head>

<body>
    <header class="container-fluid menu-home">
                   
    </header>
    
 
    <div class="block-menu"></div>
    <div class="portal">
        <p>Portal del Usuario</p>
    </div>



    @yield('content')
    <footer>
    
   </footer>
    <!-- JavaScripts -->


    <script src="js/jquery-min.js" type="text/javascript"></script>  

    <script src="js/bootstrap.min.js"></script> 
    <script src="js/Chart.min.js" type="text/javascript" "></script>



  {{--   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> --}}

    <script type="text/javascript" src="{!! asset('js/jquerymask.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('js/menu.js') !!}"></script>
     @yield('scripts')


 <script type="text/javascript">
function reply_click(clicked_id)
{
    alert(clicked_id);
}
</script>


   


    {{--  <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> --}}
     
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
    <script>   


        $('.date').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            startView: 3
        });
        $('.date').on('keydown',function(e){
            e.preventDefault();
        });
        $('.date-notificar').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
        });
        $('.date-notificar').on('keydown',function(e){
            e.preventDefault();
        });
    </script> --}}

</body>
</html>