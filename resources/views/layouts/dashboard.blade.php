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
   {{--  <link href="{{ asset('css/app.css') }}" rel="stylesheet">  --}}
    <link href="{{ asset('build/css/app-c169a2659d.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
  

       <!-- Favicon --> 
</head>
<body class="nav-md">
   <div class="container body">
      <div class="main_container">
         <div class="col-md-3 left_col ">
            <div class="left_col scroll-view">
               
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix top-20">
               <div class="profile_pic">
                  <img src="{{asset('img/logos/logo-ucv.png')}}" alt="..." class="img-circle profile">
               </div>
               <div class="profile_info">
                  <span>Bienvenido,</span>
                  <h2>{{Auth::user()->name}}</h2>
               </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
               <div class="menu_section">
                  <h3>General</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Inicio </a>
                     </li>
                  </ul>
                  <hr class = "menu-hr">
               </div>
               <div class="menu_section">
                  <h3>Carga masiva de datos</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href= "{{ action('FileController@importExportExcelORCSV')}}"><i class="fa fa-upload"></i> Cargar datos de la aplicación </a>
                     </li>
                  </ul>

                  <hr class = "menu-hr">
               </div>
               <div class="menu_section">
                  <h3>Administrar usuarios</h3>
                  <ul class="nav side-menu">
                      <li>
                        <a href= "{{ action('DashboardController@showUsers')}}"><i class="fa fa-user"></i> Listar Usuarios </a>
                     </li>

                     <li>
                        <a href= "{{ action('DashboardController@showCreateUserForm')}}"><i class="fa fa-user-plus"></i> Crear Usuario </a>
                     </li>
                      <hr class = "menu-hr">
                    
                  </ul>
               </div>
               <div class="menu_section">
                  <h3>Administrar Encuesta</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href= "{{ action('DashboardController@showCreateSurveyFormPick')}}"><i class="fa fa-clipboard"></i> Crear encuesta </a>
                     </li>
                     <li>
                        <a href= "{{ action('DashboardController@showSurvey')}}"><i class="fa fa-clipboard"></i> Visualizar encuestas </a>
                     </li>
                     <li>
                        <a href= "{{ action('DashboardController@sendSurveyButton')}}"><i class="fa fa-file-text-o"></i> Enviar encuesta </a>
                     </li>
                     <hr class = "menu-hr">
                    
                  </ul>
               </div>
               <div class="menu_section">
                  <h3>Administrar Áreas de conocimiento</h3>
                  <ul class="nav side-menu">
                     {{-- <li>
                        <a href= "{{ action('DashboardController@createKnowledgeAreaForm')}}"><i class="fa fa-book"></i> Crear Áreas de Conocmiento </a>
                     </li> --}}
                     <li>
                        <a href= "{{ action('DashboardController@viewKnowledgeAreas')}}"><i class="fa fa-book"></i> Visualizar Áreas de Conocimiento </a>
                     </li>
                     <hr class = "menu-hr">
                  </ul>
               </div>
               <div class="menu_section pdd-b">
                  <h3>Administrar Sub Áreas de Conocimiento</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href= "{{ action('DashboardController@viewSubKnowledgeAreas')}}"><i class="fa fa-book"></i> Visualizar Sub Áreas de Conocimiento </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>

        <!-- top navigation -->
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
              
             @if (Auth::check())
            <div class="col-xs-7 col-sm-3">
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i>  {{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                     <li>
                     {{ Html::linkAction('DashboardController@editLoginUserForm', 'Editar Perfil', array(Auth::user()->id)) }}    
                    </li>
                   
                    {{-- <li><a href="">Sobre OSD.</a></li> --}}
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i>Salir</a></li>
                  </ul>
                 </li>
               </ul>
             </div>
               @endif
             </div>
            </nav>
          </div>
        </div>
      
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
      	
        <!-- /page content -->

        <!-- footer content -->
   {{--      <footer>
          <div class="pull-right">
            OSD: Opine Sobre Docencia.
          </div>
          <div class="clearfix"></div>
        </footer> --}}
        <!-- /footer content -->
      </div>
   </div>

   <script
   src="https://code.jquery.com/jquery-2.2.4.min.js"
   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
   crossorigin="anonymous"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="{!! asset('build/js/all-900fea4ba6.js') !!}"></script> 
 
    
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>

    <script type="text/javascript" src="{!! asset('js/displayChart.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/dinamic-form.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/selectDate.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/dinamic-form-edit.js') !!}"></script>

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
   </script>


</body>
</html>
