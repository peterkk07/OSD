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
         <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
               <div class="navbar nav_title" style="border: 0;">
                 <a href="/" class="site_title">
                  <img id = "logo-menu-side" src="{{asset('favico.ico')}}">
               </a>
               </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
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
                        <a href="#"><i class="fa fa-home"></i> Inicio </a>
                     </li>
                  </ul>
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
                  </ul>
               </div>
               <div class="menu_section">
                  <h3>Administrar Encuesta</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href= "{{ action('DashboardController@showCreateSurveyForm')}}"><i class="fa fa-clipboard"></i> Crear encuesta </a>
                     </li>
                     <li>
                        <a href= "{{ action('DashboardController@showSurvey')}}"><i class="fa fa-clipboard"></i> Visualizar encuestas </a>
                     </li>
                    
                  </ul>
               </div>
               <div class="menu_section">
                  <h3>Administrar Áreas de conocimiento</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href= "{{ action('DashboardController@createKnowledgeAreaForm')}}"><i class="fa fa-book"></i> Crear Áreas de Conocmiento </a>
                     </li>
                     <li>
                        <a href= "{{ action('DashboardController@viewKnowledgeAreas')}}"><i class="fa fa-book"></i> Visualizar Áreas de Conocimiento </a>
                     </li>
                  </ul>
               </div>
               <div class="menu_section">
                  <h3>Administrar proceso de encuestas</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href= "{{ action('DashboardController@sendSurveyButton')}}"><i class="fa fa-file-text-o"></i> Iniciar proceso de encuestas </a>
                     </li>
                    {{--  <li>
                        <a href= "{{ action('DashboardController@viewKnowledgeAreas')}}"><i class="fa fa-book"></i> Visualizar Áreas de Conocimiento </a>
                     </li> --}}
                  </ul>
               </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
               <a data-toggle="tooltip" data-placement="top" title="Settings">
                  <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
               </a>
               <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                  <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
               </a>
               <a data-toggle="tooltip" data-placement="top" title="Lock">
                  <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
               </a>
               <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
               </a>
            </div>
            <!-- /menu footer buttons -->
            </div>
         </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i>  {{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
             
                    <li>
                      <a href="">
                        <span>Configuración</span>
                      </a>
                    </li>
                    <li><a href="">Sobre OSD.</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i>Salir</a></li>
                  </ul>
                </li>
              </ul>
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
        <footer>
          <div class="pull-right">
            OSD: Opine Sobre Docencia.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
   </div>

   
   <script src="{!! asset('js/all.js') !!}"></script> 

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript" src="{!! asset('js/dinamic-form.js') !!}"></script>
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