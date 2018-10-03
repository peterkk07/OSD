<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OSD</title>
    
      <!-- Fonts -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


   <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('build/css/app-c169a2659d.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
  

       <!-- Favicon --> 
</head>
<body class="nav-md">
   <div class="container body">
      <div class="main_container">
          <div class="col-md-3 left_col admin-dash">
           
            <div class="left_col scroll-view">
              
            <!-- menu profile quick info -->
           
            <div class="profile clearfix">
               <div class="profile_pic">
                   <img src="{{asset('img/logos/FAU-UCV-WHITE.png')}}" alt="..." class="img-circle profile">
               </div>

               @unless(Auth::check() )
                  <div class="profile_info">
                   <span class= "welcome-text">Bienvenido.</span>
                  </div>
               @endunless
            </div>
           
            <!-- /menu profile quick info -->
            <!-- sidebar menu -->
               
            @unless(Auth::check() )
            <div id="sidebar-menu2" class="main_menu_side hidden-print main_menu top-30">
               <div class="menu_section">
                  <h3>Opciones:</h3>
                  <ul class="nav side-menu">
                    {{--  Vista para estudiantes que no tienen que logearse --}}
                      <li>
                         @yield('link')
                      </li>

                     
               </div>
            </div>
            @endunless
        </div>
      </div>

        <!-- top navigation -->
     
        <div class="top_nav">
          <div class="nav_menu">
            <nav>

              <div class="row top-10">
                <div class="col-xs-2">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-7 text-center">
                    <div class="row">
                      <div class="col-xs-12 text-center hidden-xs">
                        <div class="img-menu">
                          <img class = "img-responsive" src="{{asset('favico.ico')}}">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-12 hidden-xs">
                        <h1 class="home-size">Sistema de Gestión de Evaluación del Desempeño Docente de la Facultad de Arquitectura y Urbanismo de  la UCV. </h1>
                      </div>
                    </div>
                </div>
             </div>
            </nav>
          </div>
        </div>
      
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
  
        {{-- <footer>
          <div class="pull-right">
            <p>© OSD 2018 -UCV- Facultad de Arquitectura y Urbanismo</p>
          </div>
          <div class="clearfix"></div>
        </footer> --}}
      </div>
   </div>

   
     <!-- JavaScripts -->

   <script
   src="https://code.jquery.com/jquery-2.2.4.min.js"
   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
   crossorigin="anonymous"></script>

   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

   <script src="{!! asset('build/js/all-900fea4ba6.js') !!}"></script> 
   
   <script src="{!! asset('js/ChartPie.js') !!}"></script> 

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
   <script type="text/javascript" src="{!! asset('js/dinamic-form.js') !!}"></script>
   <script type="text/javascript" src="{!! asset('js/selectDate.js') !!}"></script>
   <script type="text/javascript" src="{!! asset('js/dinamic-form-edit.js') !!}"></script>


    
     @yield('scripts')


</body>
</html>