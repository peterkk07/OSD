<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>OSD</title>

       <!-- Fonts -->
   <link href="{{asset('css/style.css')}}"  rel="stylesheet" type="text/css">
   <link href="{{asset('css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css">
   <link href="http://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">

   <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


   <script src="{{asset('js/jquery-min.js')}}" type="text/javascript"></script>  
   <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript" ></script> 
  
    {{-- make sure you are using http, and not https --}}
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script type="text/javascript">
        function init() {
            google.load("visualization", "1.1", {
                packages: ["corechart"],
                callback: 'drawCharts'
            });
        }
        function drawCharts() {

             var data = google.visualization.arrayToDataTable([
               ['', '', { role: 'style' }],
               ['Valoración del profesor(a)', {{$promTeacher}}, 'rgba(51,122,183,1)'],


               ['Valoración respecto a otros profesores del area', {{$area_score}}, '#ff4646'],            // English color name
            
           
            ]);

            var options = {
                legend: { position: 'none' },
                title: 'Valoración comparativa del profesor(a) con respecto a sus pares del mismo Área',
                 vAxis: {
                  minValue: 0,
                  ticks: [.5,1,1.5,2,2.5,3,3.5,4,4.5,5]
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>


<body onload="init()">
    
   <div class="row report">
      <div class="col-xs-10 col-xs-offset-1">
         <div class="row">
            <div class="col-xs-2">
             
                <img src=" {{asset('/img/logos/logo-ucv.png')}}" class="img-responsive" />

            </div>
            <div class="col-xs-8 text-center top-30 mg-0">
               <p>Universidad Central de Venezuela </p>
               <p>Facultad de Arquitectura y Urbanismo </p>
               <p>Escuela de Arquitectura Carlos Raúl Villanueva </p>
              
               <h3 class = "top-30">Programa de Evaluación del Desempeño Docente </h3>
            </div>
             <div class="col-xs-2">


               <img src="{{asset('/img/logos/logo_fau.jpg')}}" class="img-responsive" />
               
            </div>
         </div>
         <div class="row top-30">
            <div class="col-xs-10 col-xs-offset-1 mg-0">
               <div class="row">
                  <div class="col-xs-3">
                     <p>Asignatura: <b>{{$SubjectName}}</b></p>
                     <p>Sección: <b>{{$sectionName}}</b></p>
                     <p>Estudiantes participantes en el proceso de evaluación docente: <b>{{$CountStudentsAnswered}}</b> </p>
                  </div>
                  <div class="col-xs-6">
                     
                  </div>
                  <div class="col-xs-3">
                     <p>Profesor(a): <b>{{$TeacherName}}</b></p>
                     <p>Periodo lectivo: <b>{{$SemesterName}}</b></p>
                  </div>
               </div>

               <div class="row top-50">
                  <div class="col-xs-12">
                    <h4>Leyenda: </h4>
                  </div>
                  <div class="col-xs-12">
                    <i class="fa fa-square destacado">Aspectos destacados.</i>
                    <i class="fa fa-square mejorable">Aspectos mejorables.</i> 
                    <i class="fa fa-square bajo">Aspectos bajos.</i> 
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <div style="overflow-x:auto;">
                        <table class="table table-responsive table-report top-30">
                           <thead>
                               <th>Ítem</th>
                               <th>Valoración</th> 
                           </thead>
                           <tbody>
                              @foreach($questionsTables as $key=>$question)
                              <tr>
                              
                                 @if($items[$key]<=2.5)
                                    <td class="low-evaluation">{{$question}} </td>
                                    <td class="low-evaluation">{{ $items[$key] }} </td>
                                 @elseif(($items[$key]>=4.5))
                                    <td class="high-evaluation">{{$question}} </td>
                                    <td class="high-evaluation">{{ $items[$key] }} </td>
                                 @else
                                    <td>{{$question}} </td>
                                    <td>{{ $items[$key] }} </td>
                                 @endif
                                 
                              </tr>
                              @endforeach
                               <tr>
                                 <td></td>
                                 <td>Promedio : {{$promTeacher}} </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>   
               <div class="row top-30">
                  <div id="piechart" class="pie-chart"></div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   

</body>
</html>

















































