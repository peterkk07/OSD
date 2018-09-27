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
         ['', '', { role: 'style' }, { role: 'annotation' } ],
         ["{!! $AreaName !!}", {{$area_score}}, '#6da0e4',"{!! $area_score !!}"],            // RGB value
        
         ["{!! $AnotherAreasNames[0] !!}", {{$SubknowledgeAreasScores[0]}}, '#47484e',"{!! $SubknowledgeAreasScores[0] !!}"],

         ['{!! $AnotherAreasNames[1] !!}', {{$SubknowledgeAreasScores[1]}}, '#47484e',"{!! $SubknowledgeAreasScores[1] !!}"],

         ['{!! $AnotherAreasNames[2] !!}', {{$SubknowledgeAreasScores[2]}}, '#47484e',"{!! $SubknowledgeAreasScores[2] !!}"],

         ['{!! $AnotherAreasNames[3] !!}', {{$SubknowledgeAreasScores[3]}}, '#47484e',"{!! $SubknowledgeAreasScores[3] !!}"],

         ['{!! $AnotherAreasNames[4] !!}', {{$SubknowledgeAreasScores[4]}}, '#47484e',"{!! $SubknowledgeAreasScores[4] !!}"],

             

                          // English color name
            ]);

            var options = {

                legend: { position: 'none' },
                title: 'Valoración comparativa del Área de Conocimiento',
                 hAxis: {
                  minValue: 0,
                  ticks: [.5,1,1.5,2,2.5,3,3.5,4,4.5,5]
                }
            };
            var chart = new google.visualization.BarChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>


<body onload="init()">
    
   <div class="row">
      <div class="col-xs-10 col-xs-offset-1">
         <div class="row">
            <div class="col-xs-2">
               <img src="{{asset('img/logos/logo-ucv.png')}}" class="img-responsive" />
            </div>
            <div class="col-xs-8 text-center top-30 mg-0">
               <p>Universidad Central de Venezuela </p>
               <p>Facultad de Arquitectura y Urbanismo </p>
               <p>Unidad de Asesoramiento Académico </p>

               <h3 class = "top-30">Programa de Evaluación del Desempeño Docente </h3>
            </div>
            <div class="col-xs-2">
               <img src="{{asset('img/logos/logo_fau.jpg')}}" class="img-responsive" />
            </div>
         </div>
         <div class="row top-30">
            <div class="col-xs-12 mg-0">
               <div class="row">
                  <div class="col-xs-4">
                     <p>Sub Área de Conocimiento: {{$AreaName}}</p>
                     <p>Estudiantes Encuestados {{$CountStudentsAnswered}} </p>
                  </div>
                  <div class="col-xs-5">
                     
                  </div>
                  <div class="col-xs-3">
                     <p>Coordinador: {{$CoordinatorName}}</p>
                     <p>Semestre: {{$SemesterName}}</p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <div style="overflow-x:auto;">
                        <table class="table table-responsive table-report top-30">
                           <thead>
                               <th>Período Lectivo</th>
                               <th>Profesor(a)</th>
                               <th>Asignatura</th>
                               <th>Sección</th>
                               <th>Valoración</th> 
                           </thead>
                           <tbody>
                              @foreach($teacherNames as $key=>$TeacherName)
                              <tr>
                              
                                <td>{{$SemesterName}} </td>
                                <td>{{$teacherNames[$key]}} </td>
                                <td>{{$SubjectNames[$key]}} </td>
                                <td>{{$teacherSection[$key]}} </td>
                                 
                                 @if($TeacherScore[$key]<=2.5)
                                    
                                    <td class="low-evaluation">{{ $TeacherScore[$key] }} </td>
                                 @elseif(($TeacherScore[$key]>=4.5))
                                   
                                    <td class="high-evaluation">{{ $TeacherScore[$key] }} </td>
                                 @else
                                 
                                    <td>{{ $TeacherScore[$key] }} </td>
                                 @endif
                                 
                              </tr>
                              @endforeach
                               <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><b>Promedio : {{$teacherProm}} </b></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

              {{--   <p><i class="fa fa-circle destacado">Aspectos destacados.</i></p>
                <p><i class="fa fa-circle mejorable">Aspectos mejorables.</i> </p>
                <p><i class="fa fa-circle bajo">Aspectos bajos.</i> </p>
 --}}
         
               <div class="row top-30">
                  <div id="piechart" class="pie-chart"></div>
               </div>
            </div>   
         </div>
      </div>
   </div>
   

</body>
</html>

















































