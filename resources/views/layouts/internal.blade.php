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

            @if(Auth::check() )
              @if (Auth::user()->type_user->description == 'Profesor')
               {{-- <div class="col-md-3 left_col resize-col admin-dash">  --}}
                <?php $resize = "admin-dash";  ?>
                @else
                 <?php $resize = "";  ?>
              @endif
            @else
               <?php $resize = "";  ?>
            @endif
          
          <div class="col-md-3 left_col resize-col {{$resize}} ">
           
            <div class="left_col scroll-view">
              {{--  <div class="navbar nav_title" style="border: 0;">
                 <a href="{{ url('/') }}" class="site_title">
                  <img id = "logo-menu-side" src="{{asset('favico.ico')}}">
               </a>
               </div> --}}
          
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

                @if (Auth::check())
               <div class="profile_info">
                  <span>Bienvenido,</span>
                  <h2>{{Auth::user()->name}}</h2>

                  @if (Auth::user()->type_user->description == 'Estudiante')
                     <h4>Rol: Estudiante</h4>
                  @elseif (Auth::user()->type_user->description == 'Profesor')
                     <h4>Rol: Profesor(a)</h4>
                  @elseif (Auth::user()->type_user->description == 'Administrador')
                     <h4>Rol: Administrador</h4>

                  @elseif (Auth::user()->type_user->description == 'Coordinador_areas')
                     <h4>Rol: Coordinador(a) de Áreas</h4>

                  @elseif (Auth::user()->type_user->description == 'Coordinador_sub_areas')
                     <h4>Rol: Coordinador(a) de Sub áreas</h4>
                  
                  @elseif (Auth::user()->type_user->description == 'Directivo')
                     <h4>Rol: Directivo</h4>  
                  @endif

               </div>
                @endif
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

            @if (Auth::check())
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
               <div class="menu_section">
                  <h3 class="top-20">General</h3>
                  <ul class="nav side-menu">
                     <li>
                        <a href="{{ url('/interna') }}"><i class="fa fa-home"></i> Inicio </a>
                     </li>
                  </ul>
                  <hr class = "menu-hr">
               </div>
               <div class="menu_section">
                  <h3>Visualizar Evaluaciones</h3>
                  <ul class="nav side-menu">
                    {{--  Vista para estudiantes que no tienen que logearse --}}
                     @unless(Auth::check() )
                        <li>
                           <a href= "{{ action('InternalController@pickKnowledgeAreaEvaluation')}}"><i class="fa fa-file-text-o"></i> Elegir profesores a evaluar. </a>
                        </li>
                     @endunless

                     @if( (Auth::user()->type_user->description == 'Directivo')
                        )
                  
                        <li>
                           <a href= "{{ action('InternalController@pickKnowledgeAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación global por Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('InternalController@pickSubKnowledgeAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación global por Sub Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('InternalController@pickUserEvaluation')}}"><i class="fa fa-user"></i> Evaluación individual de profesores </a>
                        </li>

                     @endif
                     
                     @if( Auth::user()->type_user->description == 'Coordinador_areas')
                        <li>
                           <a href= "{{ action('InternalController@pickKnowledgeAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación global por Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('InternalController@pickSubKnowledgeAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación global por Sub Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('InternalController@pickUserArea')}}"><i class="fa fa-user"></i> Evaluación individual por Áreas de Conocimiento </a>
                        </li>
                         <li>
                           <a href= "{{ action('InternalController@pickUserSubArea')}}"><i class="fa fa-user"></i> Evaluación individual por Sub Áreas de Conocimiento </a>
                        </li>


                     @endif

                      @if( Auth::user()->type_user->description == 'Coordinador_areas')
               <div class="menu_section">

                      <hr class = "menu-hr">
            
                     <h3>VIZUALIZAR EVALUACIÓN COMPARATIVA</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('InternalController@pickCompareAreaEvaluation')}}"><i class="fa fa-user"></i> Evaluación comparativa de Áreas de Conocimiento </a>
                        </li>

                        <li>
                           <a href= "{{ action('InternalController@pickCompareSubAreaEvaluation')}}"><i class="fa fa-user"></i> Evaluación comparativa de Sub Áreas de Conocimiento </a>
                        </li>
                         <li>
                           <a href= "{{ action('InternalController@pickCompareUserEvaluation')}}"><i class="fa fa-user"></i> Evaluación comparativa individual de profesores </a>
                        </li>
                       
                     </ul>
                  </div>



                  <div class="menu_section">
                      <hr class = "menu-hr">
            
                      <h3>GENERACIÓN DE REPORTES</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('ReportController@reportAreaForm')}}"><i class="fa fa-users"></i> Reportes de Áreas de Conocimiento  </a>
                        </li>
                        <li>
                           <a href= "{{ action('ReportController@reportSubAreaForm')}}"><i class="fa fa-users"></i> Reportes de Sub Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('ReportController@reportTeacherForm')}}"><i class="fa fa-user"></i> Reportes de Profesores </a>
                        </li>

                         <hr class = "menu-hr">
                       
                     </ul>
                  </div>
              @endif

                     @if( Auth::user()->type_user->description == 'Coordinador_sub_areas')
                        <li>
                           <a href= "{{ action('InternalController@pickSubKnowledgeAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación global por Sub Áreas de Conocimiento </a>
                        </li>

                        <li>
                           <a href= "{{ action('InternalController@pickUserSubArea')}}"><i class="fa fa-user"></i> Evaluación individual por Sub Áreas de Conocimiento </a>
                        </li>
                     @endif

                      @if( Auth::user()->type_user->description == 'Coordinador_sub_areas')
               <div class="menu_section">

                      <hr class = "menu-hr">
            
                     <h3>VIZUALIZAR EVALUACIÓN COMPARATIVA</h3>
                     <ul class="nav side-menu">
                       
                        <li>
                           <a href= "{{ action('InternalController@pickCompareSubAreaEvaluation')}}"><i class="fa fa-user"></i> Evaluación comparativa de Sub Áreas de Conocimiento </a>
                        </li>
                         <li>
                           <a href= "{{ action('InternalController@pickCompareUserEvaluation')}}"><i class="fa fa-user"></i> Evaluación comparativa individual de profesores </a>
                        </li>
                       
                     </ul>
                  </div>

                  <div class="menu_section">
                      <hr class = "menu-hr">
            
                      <h3>GENERACIÓN DE REPORTES</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('ReportController@reportSubAreaForm')}}"><i class="fa fa-users"></i> Reportes de Sub Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('ReportController@reportTeacherForm')}}"><i class="fa fa-user"></i> Reportes de Profesores </a>
                        </li>

                         <hr class = "menu-hr">
                       
                     </ul>
                  </div>
              @endif

                     @if( Auth::user()->type_user->description == 'Profesor')
                        <li>
                           <a href= "{{ action('InternalController@pickTeacherEvaluation')}}"><i class="fa fa-user"></i> Revisar resultados de las evaluaciones </a>
                        </li>


                     @endif
                  </ul>
               </div>
               @if( Auth::user()->type_user->description == 'Profesor')
               <div class="menu_section">

                      <hr class = "menu-hr">
            
                     <h3>VIZUALIZAR EVALUACIÓN COMPARATIVA</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('InternalController@pickCompareTeacherIndividual')}}"><i class="fa fa-user"></i> Evaluación comparativa individual </a>
                        </li>
                       
                     </ul>
                  </div>

                  <div class="menu_section">

                      <hr class = "menu-hr">
            
                     <h3>GENERACIÓN DE REPORTES</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('ReportController@reportIndividualTeacherForm')}}"><i class="fa fa-user"></i> Generar reporte de evaluación </a>
                        </li>
                     </ul>
                  </div>
              @endif
            
               
               @if( (Auth::user()->type_user->description == 'Directivo'))
                  <div class="menu_section">

                      <hr class = "menu-hr">
            
                     <h3>VIZUALIZAR EVALUACIÓN COMPARATIVA</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('InternalController@pickCompareAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación comparativa de Áreas de Conocimiento  </a>
                        </li>
                        <li>
                           <a href= "{{ action('InternalController@pickCompareSubAreaEvaluation')}}"><i class="fa fa-users"></i> Evaluación comparativa de Sub Áreas de Conocimiento  </a>
                        </li>
                        <li>
                           <a href= "{{ action('InternalController@pickCompareUserEvaluation')}}"><i class="fa fa-user"></i> Evaluación comparativa individual de profesores </a>
                        </li>

                         <hr class = "menu-hr">
                       
                     </ul>
                  </div>
                  <div class="menu_section">
                     
                     <h3>GENERACIÓN DE REPORTES</h3>
                     <ul class="nav side-menu">
                        <li>
                           <a href= "{{ action('ReportController@reportAreaForm')}}"><i class="fa fa-users"></i> Reportes de Áreas de Conocimiento  </a>
                        </li>
                        <li>
                           <a href= "{{ action('ReportController@reportSubAreaForm')}}"><i class="fa fa-users"></i> Reportes de Sub Áreas de Conocimiento </a>
                        </li>
                        <li>
                           <a href= "{{ action('ReportController@reportTeacherForm')}}"><i class="fa fa-user"></i> Reportes de Profesores </a>
                        </li>

                         <hr class = "menu-hr">
                       
                     </ul>
                  </div>
               @endif
            </div>

            @endif
           
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