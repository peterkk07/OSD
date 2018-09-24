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
   <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">


   <script src="{{asset('js/jquery-min.js')}}" type="text/javascript"></script>  
   <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript" ></script> 
   <script src="{{asset('js/Chart.min.js')}}" type="text/javascript" ></script>
   
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
                ['Task', 'Hours per Day'],
                ['Coding', 11],
                ['Eat', 1],
                ['Commute', 2],
                ['Looking for code Problems', 4],
                ['Sleep', 6]
            ]);
            var options = {
                title: 'My Daily Activities',
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>


<body onload="init()">
    
   <h1>aca </h1>
   <div class="container register">
      <div class="row">
            <div class="col-xs-12 size-p">
                <h3 class="text-center">Elija el tipo de usuario que desea visualizar</h3>

                 <img src="/img/logos/logo-ucv.png" />
            </div>
      </div>

        <div id="count-container" class = "top-30">
            <div id="count-content">
                  
            </div>      
        </div>


        <div id="question-container" class = "top-30">
            <div id="question-content">
                  
            </div>      
        </div>

  
   </div>
   
   <div id="piechart" class="pie-chart"></div>
   

</body>
</html>

















































