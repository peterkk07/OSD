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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
     <link href="{{ asset('css/general.css') }}" rel="stylesheet" type="text/css">
       <!-- Favicon --> 


</head>

<body>
   <header class="container-fluid menu-home">
       <a href="../" class="col-xs-8 pull-left">
            <img src="{{asset('img/logo-netuno.png')}}" class="img-responsive"/>
        </a>
        <ul class="col-xs-10 hidden-xs hidden-sm nav navbar-nav navbar-center menu-section">
            <li><a href="">INICIO</a></li>

             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">SERVICIOS
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    
                    <li><a href="">MIS SERVICIOS</a></li> 
                    <li><a href="">COMPRAS EN LINEA</a></li>
                </ul>
            </li>
             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">PAGOS
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="">MIS FACTURAS</a></li>
                    <li><a href="">DOMICILIAR</a></li>
                    <li><a href="">NOTIFICAR PAGO</a></li>
                </ul>
            </li>
            
             <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">PERFIL
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="">Editar datos</a></li>
                        <li><a href="">Cambiar contraseña</a></li>
                    </ul>
                </li>
            <li><a href="">SALIR</a></li>
           
        </ul>
        <div class="pull-right btn-menu">
            Menú &nbsp;&nbsp;
            <span class="fa-stack fa-lg opener-menu">
                <i class="fa fa-circle-thin fa-stack-2x"></i>
                <i class="fa fa-bars fa-stack-1x"></i>
            </span>
        </div>
    </header>
    
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 menu-complete">
        <div class="col-xs-12 text-right">
            <span class="fa-stack fa-lg closer-menu">
                <i class="fa fa-circle-thin fa-stack-2x"></i>
                <i class="fa fa-times fa-stack-1x"></i>
            </span>
        </div>

        <nav class="hidden-md hidden-lg col-xs-12">
            <h3>Mi Cuenta</h3>
            <ul>
                <li><a href="">MIS SERVICIOS</a></li> 
                <li><a href="">COMPRAS EN LINEA</a>
                <li><a href="">MIS FACTURAS</a></li>
                <li><a href="">DOMICILIAR</a></li>
                <li><a href="">NOTIFICAR PAGO</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">PERFIL
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="">Editar datos</a></li>
                        <li><a href="">Cambiar contraseña</a></li>
                    </ul>
                </li>
                <li><a href="">SALIR</a></li>
            </ul>
        </nav>
        <nav class="col-xs-12">
            <h3><a href="../home">NetUno</a></h3>
            <ul>
                <li><a href="../contacto">CONTACTO</a></li>
                <li><a href="../empleos">EMPLEOS</a></li>
                <li><a href="../nosotros">NOSOTROS</a></li>
                <li><a href="../medios-de-pago">MEDIOS DE PAGO</a></li>
            </ul>
            <a href="../personas"><h3>Personas</h3> </a>
            <ul>
                <li><a href="../personas/internet">Internet</a></li>
                <li><a href="../personas/television">Televisión</a></li>
                <li><a href="../personas/telefonia">Telefonía</a></li>
                <li><a href="../netunopresenta">NetUno Presenta</a></li>
            </ul>
           <a href="../empresas"><h3>Empresas</h3> </a>
            <ul>
                <li><a href="../empresas/internet">Internet</a></li>
                 <li><a href="../empresas/internet">Transmisión de datos</a></li>
                <li><a href="../empresas/television">Telefonía</a></li>
                <li><a href="../empresas/televisión">Televisión</a></li>
                <li><a href="../empresas/insercion">Inserción Publicitaria</a></li>
            </ul>
            <a href="../empresas"><h3>NetUno Presenta</h3> </a>
            <ul>
                <li><a href="../empresas/internet">NetUno</a></li>
                 <li><a href="../empresas/internet">Productos</a></li>
                <li><a href="../empresas/television">Premium</a></li>
                <li><a href="../empresas/televisión">Promociones</a></li>
            </ul>
        </nav>
    </div>
    <div class="block-menu"></div>
    <div class="portal">
        <p>Portal del Usuario</p>
    </div>



    @yield('content')
    <footer>
    <div class="container">
        <div class="row wrap-menu-footer">
            <div class="col-xs-12 col-md-3" id="logo-footer">
                <img src="/images/footer-netuno.png" class="img-responsive">
            </div>

            <div class="col-xs-12 col-md-7 hidden-xs menu-footer">
                <ul class="col-xs-4">
                    <h4><a href="/personas/">Personas</a></h4>
                    <li><a href="/personas/internet/">Internet</a></li>
                    <li><a href="/personas/television/">Televisión</a></li>
                    <li><a href="/personas/telefonia/">Telefonía</a></li>
                    <li><a href="/netunopresenta/">NetUno Presenta</a></li>
                    <li><a href="/oficinas/">Servicio al cliente</a></li>
                </ul>
                <ul class="col-xs-4">
                    <h4><a href="/empresas/">Empresas</a></h4>
                    <li><a href="/empresas/internet/">Internet</a></li>
                    <li><a href="/empresas/transmision/">Transmisión de Datos</a></li>
                    <li><a href="/empresas/television/">Televisión</a></li>
                    <li><a href="/empresas/insercion/">Inserción Publicitaria</a></li>
                </ul>
                <ul class="col-xs-4">
                    <h4>NetUno</h4>
                    <li><a href="/nosotros/">Nosotros</a></li>
                    <li><a href="/empleos/">Empleo</a></li>
                    <li><a href="/contacto/">Contacto</a></li>
                    <li><a href="/medios-de-pago">Medios de Pago</a></li>
                </ul>
            </div>

            <div class="col-xs-12 col-md-2 rss-icons">
                <a href="https://www.facebook.com/NetUnoOficial/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/NetUnoOficial/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                <a href="https://www.linkedin.com/company/52842/" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" id="copyright">
                <p><a href="#">Términos y condiciones</a> | <a href="3">Políticas de Privacidad</a><br class="hidden-md hidden-lg"><span class="hidden-xs hidden-sm"> - </span>NETUNO Todos los derechos reservados &copy; 2018 <br class="hidden-md hidden-lg">RIF: J-30108335-0</p>
            </div>
        </div>
    </div>
</footer>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{!! asset('js/jquerymask.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('js/menu.js') !!}"></script>
    
    
    <script>
        $('.credit-card').mask('00/00');
        $(".code").mask('000');
    </script>


 <script type="text/javascript">
function reply_click(clicked_id)
{
    alert(clicked_id);
}
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
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

    </script>

</body>
</html>
